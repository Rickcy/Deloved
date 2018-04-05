<?php

use common\models\Deal;

use common\models\User;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Deal Online');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="deal-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php if($user->freeUser()):?>
    Данный контент доступен только для пользователей с  <a href="/admin/billing/index">расширенной подпиской</a>
    <?php else:;?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (User::checkRole(['ROLE_USER'])):?>
    <div class="row">
    <div class="col-xs-4">
        <select class="form-control" name="statuses" id="statuses">
            <option value="0">Выберите статус</option>
            <?php foreach (Deal::getAllStatuses() as $status):?>
                <option value="<?=$status?>"><?=$status?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-xs-4">
        <select class="form-control" name="sides" id="sides">
            <option value="0">Выберите роль</option>
            <option value="Продавец">Продавец</option>
            <option value="Покупатель">Покупатель</option>
        </select>
    </div>
    </div>
    <?php endif;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Accounts')?></td>



                <td><?=Yii::t('app', 'Status')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>
                <?php if (User::checkRole(['ROLE_ADMIN'])):?>
                    <td><?=Yii::t('app', 'Действия')?></td>
                <?php else:?>
                    <td><?=Yii::t('app', 'Ваша роль')?></td>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            /**
             * @var $deal \common\models\Deal
             */
            foreach ($deals as $deal):?>
                <tr class="deal-t <?=$i%2 == 0 ? "even" : "odd"?>">

                    <td >
                        <?= $deal->id ?>

                    </td >

                    <td class="deal-<?=$deal->id?>">
                        <?= Html::a(\common\models\Account::getTrimName($deal->buyer->account->brand_name).' и '.\common\models\Account::getTrimName($deal->seller->account->brand_name), ['show', 'id' => $deal->id]) ?>

                    </td>
                    <td class="status" status="<?=Deal::getNameStatus($deal->status)?>">
                        <?= Deal::getNameStatus($deal->status) ?>
                    </td>

                    <td><?=(new DateTime($deal->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>

                    <?php if (User::checkRole(['ROLE_ADMIN'])):?>
                        <td>   <?= Html::a('', ['delete', 'id' => $deal->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this deal?'),
                                'method' => 'post',
                            ],])?></td>

                    <?php else:?>
                        <td class="side" side="<?= $deal->buyer_id == $user->profile->id ? 'Покупатель' : 'Продавец'?>"><?= $deal->buyer_id == $user->profile->id ? 'Покупатель' : 'Продавец'?></td>
                    <?php endif;?>


                </tr>
                <?php
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="selectDeal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contact-content" style="width:100%;margin: 0 auto">
            <div class="modal-header" style="background-color: #94C43D">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title " id="name-modal-title" style="text-align: center;color: white"></h4>
            </div>

            <div class="modal-body" >
                <div class="row">
                    <div class="col-sm-11 col-sm-offset-1" id="name-modal-body">
                    </div>
                    <div class="col-sm-6" style="margin-top: 15px">
                        <a href="/admin/ticket/create"  class="btn btn-primary" style="width:100%" >Служба поддерки</a>
                    </div>
                    <div class="col-sm-6" style="margin-top: 15px">
                        <a href="javascript:void(0)" class="btn btn-default"  data-dismiss="modal" aria-hidden="true" style="width:100%" >Продолжить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var hash = window.location.hash;
            if(hash == '#select-for-review'){
                $('#name-modal-title').text('Хотите оставить озыв о партнере?');
                $('#name-modal-body').append('Выбирите Сделку по которой хотите оставить Отзыв!')
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append('Если у вас возникли вопросы воспользуйтесь Службой поддержки!')
                $('#selectDeal').modal('show');


            }
            else if(hash == '#select-for-claim'){
                $('#name-modal-title').text('Хотите подать Иск?');
                $('#name-modal-body').append('Выбирите Сделку по которой хотите подать Иск!')
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append('Если у вас возникли вопросы воспользуйтесь Службой поддержки!')
                $('#selectDeal').modal('show');


            }
            else if(hash == '#select-for-dispute'){
                $('#name-modal-title').text('Хотите Разрешить Спор?');
                $('#name-modal-body').append('Выбирите Сделку по которой хотите разрешить Спор!\n')
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append($('<br>'))
                $('#name-modal-body').append('Если у вас возникли вопросы воспользуйтесь Службой поддержки!')
                $('#selectDeal').modal('show');


            }
        })
    </script>
    <?php endif;?>
</div>
