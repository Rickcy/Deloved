<?php
use common\models\Ticket;
use common\models\User;

$user = User::findOne(Yii::$app->user->id);
$myProfile = $user->profile;
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>
<?php foreach ($posts as $post):?>
    <div class="thread-post row" name="post" id="<?= $post->id?>">

        <input type="hidden" name="postId" value="<?= $post->id?>">
        <!--                Начало аватара. Показывать в случае сообщения собеседника -->

        <?php if ($post->profile->id !== $myProfile->id):?>
            <div class="thread-avatar col-xs-1">
                <?php if($post->profile->account):?>
                    <?php if($post->profile->account->logos):?>
                        <img src="<?=$post->profile->account->logos->file?>" alt="">
                    <?php else:?>
                        <img src="/uploads/default/default_avatar.jpg" alt="">
                    <?php endif;?>
                <?php else:?>
                    <img src="/uploads/default/default_avatar.jpg" alt="">
                <?php endif;?>
            </div>
        <?php endif;?>

        <!--                Конец аватара-->

        <div class="thread-subject <?= $post->profile->id !== $myProfile->id ? 'col-xs-10':'col-xs-11'?>">

            <?php if($post->profile->account):?>
                <span class="nickname"><?= $post->profile->account->brand_name?></span>
            <?php else:?>
                <span class="nickname"><?= $post->profile->fio?></span>
            <?php endif;?>

            <!--                    Тело сообщения в случае если это статус-->
            <?php if($post->status != null):?>
                <div name="post" class="<?= $post->profile->id !== $myProfile->id ? 'bubble bubble-in bubble-status' : 'bubble bubble-out bubble-status'?>">
                    <b>Изменен статус : </b><b style="color: green"><?= Ticket::getNameStatus($post->status)?></b>
                </div>
            <?php else:?>
                <!--                        Тело соодбщения. Меняет фон и выранивание в зависимости от сторон-->
                <div class="<?= $post->profile->id !== $myProfile->id ? 'bubble bubble-in bubble-status' : 'bubble bubble-out bubble-status'?>">
                    <?=$post->post?>
                    <!--                            Обработка случая, если к сообщению приложены файлы-->
                    <?php if ($post->ticketPostAttaches):?>
                        <div align="left">
                            <?php foreach ($post->ticketPostAttaches as $attach):?>
                                <table style="display: inline-block; margin: 5px" id="<?= $attach->id?>">
                                    <tr>
                                        <td style="padding-right: 10px" rowspan="2">
                                            <a style="text-decoration: none" href="<?=Url::to([$attach->attachment->filePath])?>"
                                               download="<?=$attach->attachment->filePath?>" data-gallery>
                                            </a>
                                        </td>
                                        <td>
                                            Файл
                                        </td>
                                    </tr>
                                </table>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>

                </div>
            <?php endif;?>

        </div>
        <div class="thread-time col-xs-1">
            <?=(new DateTime($post->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('m.d.Y')?><br>
            <?=(new DateTime($post->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('H:i:s')?>

        </div>

    </div>
<?php endforeach;?>