<?php

use common\models\User;
use yii\bootstrap\Html;
use yii\jui\AutoComplete;


/** @var $profile common\models\Profile**/

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone');
?>
<div class="profile-info">
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="fio"><?= Yii::t('app','Fio')?></label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="fio" name="fio" class="form-control" type="text" readonly value="<?=Html::encode($profile->fio)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr"></div>
        </div>

    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="profile_date"></label>
        </div>

            <a class="value-col ft change-pass" href="/admin/profile/password" ><?=Yii::t('app','Change password')?> </a>

    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="city"><?= Yii::t('app','City')?></label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <?php
            echo AutoComplete::widget([
                'name'=>'profile_city',
                'value'=>isset($profile->city->name)?$profile->city->name:'',
                'id'=>'city',


                'clientOptions' => [
                    'source' => $city_list,
                    'autoFill'=>true,
                    'minLength' => 2,

                ],
                'options'=>[
                    'placeholder'=>'Отсутствует',
                    'data-old'=>isset($profile->city->name)?$profile->city->name:'',
                    'readonly'=>true,
                     'class'=>'form-control'
                ]
            ])
            ?>
            <div class="pods fr">Город, к которому будет прикреплен ваш профиль</div>
        </div>
        <div class="col-sm-1 col-xs-1">
           <span name="change" data-for="city" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="email"><?= Yii::t('app','Email')?></label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="email" name="email"  class="form-control" type="text" readonly value="<?=Html::encode($profile->email)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Контактный адрес электронной почты</div>
        </div>

    </div>


    <?php if (in_array($user->role->role_name, ['ROLE_MANAGER','ROLE_JURIST','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_SUPPORT'])):?>
        <div class="row">
            <div class="col-sm-3 label-col ft  col-sm-offset-1">
                <label for="experience"><?= Yii::t('app','Experience')?></label>
            </div>
            <div class="col-sm-7 ft ">
                <input id="experience"  class="form-control" name="experience" type="text" readonly value="<?=Html::encode($profile->getExperience()->one()->experience)?>"
                       placeholder="Отсутствует"/>
                <div class="pods fr">Стаж работы по данной специальности</div>
            </div>

        </div>
    <?php endif;?>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="date_reg"><?= Yii::t('app','Date registration')?></label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="date_reg"  class="form-control" name="date_reg" type="text" readonly value="<?=Yii::$app->formatter->asDatetime($profile->created_at+$timeZone*60, "php:d.m.Y H:i:s")?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr"></div>
        </div>
        <div class="action-col">
            <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
        </div>
    </div>

    <?php if (User::checkRole(['ROLE_USER'])):?>

        <div class="row">
            <div class="col-sm-3 label-col ft  col-sm-offset-1">
                <label for="profile_date">Статус подписки</label>
            </div>
            <div class="col-sm-7 ft ">
                <input id="profile_date"  class="form-control" name="profile_date" type="text" readonly value="<?=$profile->chargeStatus==1 ? Yii::t('app','Extended').' '.($profile->chargeTill ? $profile->chargeTill : ''):Yii::t('app','Starting')?>" />
                <div class="pods fr"></div>
            </div>
        </div>


    <?php endif;?>

</div>

<script>
    $(document).ready(function() {
        $('[name=change]').click(function (e) {

            var el = e.target || e.srcElement;

            var prop = $(el).data('for');

            if ($('#' + prop).is('[readonly]')) {
                $('#' + prop).attr('readonly', false);
                $(el).removeClass('glyphicon-pencil').removeClass('pen');
                $(el).addClass('glyphicon-ok').addClass('ok')

            } else {
                var oldValue = $('#' + prop).data('old');
                var newValue = $('#' + prop).val();
                if (oldValue != newValue) {
                    console.log(newValue)
                    console.log(prop)
                    $.ajax({
                        type: 'POST',
                        url: "/admin/profile/edit-new/?value=" + newValue + '&prop=' + prop,

                        beforeSend: function () {
                            $('#' + prop + 'spinner').show();
                        },
                        complete: function (textStatus) {
                            $('#' + prop + 'spinner').hide();
                            if (textStatus.status) {

                            } else {

                            }
                        },
                        success: function (data, textStatus) {
                            var obj = $.parseJSON(data);


                            if (obj.success) {
                                $('#' + prop).data('old', newValue);
                                showMessage('success', obj.success)

                            }
                            if (obj.danger) {
                                $('#' + prop).val(oldValue);
                                showMessage('danger', obj.danger)
                            }

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showMessage('danger', 'Ошибка соединения');
                            console.log('Ошибка соединения')
                        }
                    })
                }
                $('#' + prop).attr('readonly', true);
                $(el).removeClass('glyphicon-ok').removeClass('ok');
                $(el).addClass('glyphicon-pencil');
            }
        });
    })
</script>