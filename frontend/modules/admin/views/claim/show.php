<?php
/**
 * @var $post \common\models\ClaimPost
 * @var $claim \common\models\Claim
 */

use common\models\Claim;

use common\models\User;
use frontend\assets\ClaimChatAsset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
ClaimChatAsset::register($this);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
$user = User::findOne(Yii::$app->user->id);
$myProfile = $user->profile;
$this->title = Yii::t('app', 'Claim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Claim'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-show">
    <br>
    <br>
    <div>
        <label for="claimId">Номер иска:</label>
        <span id="claimId"><?=$claim->id?></span>
    </div>

    <div>
        <label for="deal">Сделка:</label>
        <span id="deal"><a href="/admin/deal/show?id=<?=$claim->deal_id?>">Иск открыт по данной сделке</a></span>
    </div>

    <div>
        <label for="status">Статус иска:</label>
        <span id="status"><?=Claim::getNameStatus($claim->status)?></span>
    </div>
    <br>
    <br>

    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <td><span id="partner">
			<div class="class">Истец:</div><a href="/companies/item?id=<?=$claim->profile->account->id?>"><?=$claim->profile->account->brand_name?></a>
		</span></td>
                <td align="center">Контрагент</td>
                <td align="right"><span id="partner">
			<div class="class2">Ответчик:</div> <a href="/companies/item?id=<?=$claim->partner->account->id?>"><?=$claim->partner->account->brand_name?></a>
		</span></td>
            </tr>
            <tr>
                <td><span id="partner"><?=$claim->profile->fio?></span></td>
                <td align="center">ФИО руководителя</td>
                <td align="right"><span id="partner"><?=$claim->partner->fio?></span></td>
            </tr>
        </table>
    </div>
    
    
    <div id="scrollContent"  data-mcs-theme="dark">
        <div id="postArea">
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
                                <b>Изменен статус : </b><b style="color: green"><?= Claim::getNameStatus($post->status)?></b>
                            </div>
                        <?php else:?>
                            <!--                        Тело соодбщения. Меняет фон и выранивание в зависимости от сторон-->
                            <div class="<?= $post->profile->id !== $myProfile->id ? 'bubble bubble-in bubble-status' : 'bubble bubble-out bubble-status'?>">
                                <?=$post->post?>
                                <!--                            Обработка случая, если к сообщению приложены файлы-->
                                <?php if ($post->claimPostAttaches):?>
                                    <div align="left">
                                        <?php foreach ($post->claimPostAttaches as $attach):?>
                                            <table style="display: inline-block; margin: 5px" id="<?= $attach->id?>">
                                                <tr>
                                                    <td style="padding-right: 10px" rowspan="2">
                                                        <a style="text-decoration: none" href="<?=Url::to([$attach->attachment->filePath])?>"
                                                           download="<?=$attach->attachment->filePath?>" data-gallery>
                                                            <img src="/uploads/default/file.png" alt="">
                                                        </a>
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
        </div>
    </div>
    <?php if ($claim->status != Claim::STATUS_FAILED && $claim->status != Claim::STATUS_RESOLVE && $claim->status != Claim::STATUS_RESOLVE_WS && $claim->status != Claim::STATUS_RETURN ):?>
        <?php if ($user->checkRole(['ROLE_MANAGER','ROLE_JUDGE','ROLE_ADMIN'])):?>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-1"></div>

                <div class="col-md-10" style="border-radius: 5px;padding: 10px;
					background-color: #f4f4f4;box-shadow: inset 0px 0px 10px #d7d7d7">


                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown" style="border-radius: 15px;border: 1px solid rgba(255, 0, 0, 0.36)" >
                            <?=Yii::t('app','Change status')?>
                            <span style="margin-left: 5px" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach(Claim::getNextAllowedStatuses($claim->status) as $key => $val):?>
                                <li><a id="status-<?=$key?>" href="javascript:void(0)"
                                       onclick="return setStatus(<?=$key?>);"><?=$val?></a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="hidden">
                <?php $form = ActiveForm::begin(['id'=>'claim-status-form','action'=>'/admin/claim/change-status'])?>
                <?= $form->field($model,'last_post_id')->hiddenInput(['id'=>'claim-last-post-instatus'])->label('')?>
                <?= $form->field($model,'claim_id')->hiddenInput(['value'=>$claim->id])->label('')?>
                <?= $form->field($model,'status')->hiddenInput(['id'=>'claim-status-val'])->label('')?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif;?>
        <div id="form-claim-post" style="display: <?=$claim->status == Claim::STATUS_NEW || $claim->status == Claim::STATUS_FAILED || $claim->status == Claim::STATUS_RESOLVE_WS  ? 'none' : 'block'?>">
            <?php $form = ActiveForm::begin(['id'=>'claim-post-form','action'=>'/admin/claim/send-message','options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '<div class="col-sm-10 col-sm-offset-1">{input}</div><div class="row"><div class="col-sm-4 col-sm-offset-4">{error}</div></div>',
            ]]);
            ?>
            <?= $form->field($model,'last_post_id')->hiddenInput(['id'=>'claim-last-post-inpost'])->label('')?>
            <?= $form->field($model,'claim_id')->hiddenInput(['value'=>$claim->id])->label('')?>
            <?= $form->field($model, 'post')->textarea(['rows'=>5,'maxlength'=>255,'placeholder'=>Yii::t('app','Your message')])->label('') ?>
            <div class="row" >
                <div class="col-xs-12">
                    <div class="col-xs-6 col-xs-offset-0 col-sm-offset-1 text-left">
                        <?= Html::submitButton( Yii::t('app', 'Send') , ['class' =>  'btn create-btn btn-sm btn-success','id'=>'send-message' ]) ?>
                    </div>
                    <div class="col-xs-4 text-right">
                        <?= Html::button( Yii::t('app', 'Attach file') , ['class' =>  'noFile btn create-btn btn-sm btn-success' ]) ?>
                        <input type="file" class="hidden" claim-id =<?=$claim->id?>  id="file">
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    <?php endif;?>
</div>

