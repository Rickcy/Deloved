<?php
/**
 * @var $post \common\models\DealPost
 * @var $deal \common\models\Deal
 */
/* @var $this \yii\web\View */
use common\models\Deal;
use common\models\User;
use frontend\assets\DealChatAsset;
use frontend\assets\TicketChatAsset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
DealChatAsset::register($this);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
$user = User::findOne(Yii::$app->user->id);
$myProfile = $user->profile;
$this->title = Yii::t('app', 'Deal Online');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deal Online'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-show">
    <div id="deal-info">
        <div class="row">
            <div class="col-sm-12" style="font-size: 1.2em">
                <div id="dealSides" name="dealSides">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-sm-6 col-xs-12 text-center">
                                <div class="col-xs-12">Покупатель</div>
                                <div class="col-xs-12">
                                    <a href="/companies/item?id=<?=$deal->buyer->account->id?>">
                                        <?php if($deal->buyer->account->logos):?>
                                            <img style="width: 90px" src="<?=$deal->buyer->account->logos->file?>" alt="">
                                        <?php else:?>
                                            <img style="width: 90px" src="/uploads/default/default_avatar.jpg" alt="">
                                        <?php endif;?>
                                        <p style="margin-top: 2%"><?=$deal->buyer->account->brand_name?></p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xs-12 text-center">
                                <div class="col-xs-12">Продавец</div>
                                <div class="col-xs-12">
                                    <a href="/companies/item?id=<?=$deal->seller->account->id?>">
                                        <?php if($deal->seller->account->logos):?>
                                            <img style="width: 90px" src="<?=$deal->seller->account->logos->file?>" alt="">
                                        <?php else:?>
                                            <img style="width: 90px" src="/uploads/default/default_avatar.jpg" alt="">
                                        <?php endif;?>
                                        <p style="margin-top: 2%"><?=$deal->seller->account->brand_name?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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


                            <span class="nickname"><?= $post->profile->account->brand_name?></span>


                        <!--                    Тело сообщения в случае если это статус-->
                        <?php if($post->status != null):?>
                            <div name="post" class="<?= $post->profile->id !== $myProfile->id ? 'bubble bubble-in bubble-status' : 'bubble bubble-out bubble-status'?>">
                                <b>Изменен статус : </b><b style="color: green"><?= Deal::getNameStatus($post->status)?></b>
                            </div>
                        <?php else:?>
                            <!--                        Тело соодбщения. Меняет фон и выранивание в зависимости от сторон-->
                            <div class="<?= $post->profile->id !== $myProfile->id ? 'bubble bubble-in bubble-status' : 'bubble bubble-out bubble-status'?>">

                                    <?=$post->post?>

                                <!--                            Обработка случая, если к сообщению приложены файлы-->
                                <?php if ($post->dealPostAttaches):?>
                                    <div align="left">
                                        <?php foreach ($post->dealPostAttaches as $attach):?>
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
    <?php if (User::checkRole(['ROLE_USER'])):?>
    <?php if ($deal->status != Deal::SUSPENDED || $deal->status != Deal::FAILED || $deal->status != Deal::REJECTED || $deal->status != Deal::CONFIRMED):?>

        <?php if ($deal->buyer_id == $myProfile->id || $deal->seller_id == $myProfile->id ):?>
    <div id="dealProgress" >
            <?=$this->render("partials/progress",['status'=>$deal->status])?>
    </div>
            <div class="row" id="deal-statuses-row" style="margin-top: 10px;display: <?=$deal->status == Deal::CONFIRMED || $deal->status == Deal::REJECTED  ? 'none' : 'block'?>">
                <div class="col-md-1"></div>

                <div class="col-md-10" style="border-radius: 5px;padding: 10px;
					background-color: #f4f4f4;box-shadow: inset 0px 0px 10px #d7d7d7">


                    <div class="btn-group">
                        <button type="button" class="change-statuses btn btn-default dropdown-toggle"
                                data-toggle="dropdown" style="border-radius: 15px;border: 1px solid rgba(255, 0, 0, 0.36)" >
                            <?=Yii::t('app','Change status')?>
                            <span style="margin-left: 5px" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  id="deal-statuses" role="menu">
                            <?php foreach($deal->getNextAllowedStatuses($deal->status) as $key => $val):?>
                                <li><a id="status-<?=$key?>" href="javascript:void(0)"
                                       onclick="return setStatus(<?=$val?>);"><?=Deal::getNameStatus($val)?></a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="hidden">
                <?php $form = ActiveForm::begin(['id'=>'deal-status-form','action'=>'/admin/deal/change-status'])?>
                <?= $form->field($model,'last_post_id')->hiddenInput(['id'=>'deal-last-post-instatus'])->label('')?>
                <?= $form->field($model,'deal_id')->hiddenInput(['value'=>$deal->id])->label('')?>
                <?= $form->field($model,'status')->hiddenInput(['id'=>'deal-status-val'])->label('')?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif;?>
        <div id="form-deal-post" style="display: <?=$deal->status == Deal::PROPOSED || $deal->status == Deal::CONFIRMED || $deal->status == Deal::REJECTED  ? 'none' : 'block'?>">
            <?php $form = ActiveForm::begin(['id'=>'deal-post-form','action'=>'/admin/deal/send-message','options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '<div class="col-sm-10 col-sm-offset-1">{input}</div><div class="row"><div class="col-sm-4 col-sm-offset-4">{error}</div></div>',
            ]]);
            ?>
            <?= $form->field($model,'last_post_id')->hiddenInput(['id'=>'deal-last-post-inpost'])->label('')?>
            <?= $form->field($model,'deal_id')->hiddenInput(['value'=>$deal->id])->label('')?>
            <?= $form->field($model, 'post')->textarea(['rows'=>5,'maxlength'=>1000,'placeholder'=>Yii::t('app','Your message')])->label('') ?>
            <div class="row" >
                <div class="col-sm-11 col-xs-offset-1">
                    <div class="col-xs-12 col-sm-8">
                        <?= Html::submitButton( Yii::t('app', 'Send') , ['class' =>  'btn create-btn btn-sm btn-success','id'=>'send-message' ]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <?= Html::button( Yii::t('app', 'Attach file') , ['class' =>  'noFile btn create-btn btn-sm btn-success' ]) ?>
                        <input type="file" class="hidden" deal-id =<?=$deal->id?>  id="file">
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    <?php endif;?>

    <div class="row" style="margin-top: 15px">
        <div class="col-sm-11 col-xs-offset-1">
            <div class="col-sm-4">

                <a  class="review-button" href="/admin/review/create?id=<?=$deal->id?>"><?=Yii::t('app', 'Write Review')?></a>
            </div>
            <div class="col-sm-4">
                <a class="jud-button" href="/admin/claim/create?id=<?=$deal->id?>"><?=Yii::t('app', 'Submit Claim')?></a>
            </div>
            <div class="col-sm-4">
                <a class="claim-button" href="/admin/dispute/create?id=<?=$deal->id?>"><?=Yii::t('app', 'Resolve Dispute')?></a>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
<div class="modal fade" id="Status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px!important;">
        <div class="modal-content contact-content" style="width:80%;margin: 0 auto">
            <div class="modal-header" style="background-color: #94C43D">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title " style="text-align: center;color: white">Вы уверены что хотите подписать договор?</h4>
            </div>

            <div class="modal-body row">
                <div class="col-sm-12">
                    <b>Внимание!</b><br>Для рассмотрения возможных споров по сделке в Третейском суде «Деловед» Вам необходимо включить в договор третейскую оговорку. <a href="http://delovedsud.ru/appeal/" target="blank">Подробнее...</a>
                    <br>
                    <div class="col-sm-6" style="margin-top: 15px">
                        <a href="/admin/document/contract-for-services" class="btn btn-success" >Подготовить договор на оказание услуг</a>
                    </div>
                    <div class="col-sm-6" style="margin-top: 15px">
                        <a href="/admin/document/delivery-contract" class="btn btn-success"  >Подготовить договор поставки</a>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <div class="col-sm-6" style="margin-top: 15px">
                    <a href="/admin/consult/create"  class="btn btn-primary" style="width:100%" >Помощь юриста</a>
                </div>
                <div class="col-sm-6" style="margin-top: 15px">
                    <a href="javascript:void(0)" class="btn btn-success" id="change-status-success"  style="width:100%" >Подписать договор</a>
                </div>
            </div>

        </div>
    </div>
</div>

