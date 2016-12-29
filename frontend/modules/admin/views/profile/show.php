<?php

use common\models\User;
use yii\bootstrap\Html;
use yii\jui\AutoComplete;


/** @var $profile common\models\Profile**/

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="profile-info">
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="label-col ft">
            <label for="fio">Fio</label>
        </div>
        <div class="value-col ft">
            <input id="fio" name="fio" type="text" readonly value="<?=Html::encode($profile->fio)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr"></div>
        </div>
        <div class="action-col">
<!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
        </div>
    </div>


    <div class="row">
        <div class="label-col ft">
            <label for="city">City</label>
        </div>
        <div class="value-col ft">
            <?
            echo AutoComplete::widget([
                'name'=>'profile_city',
                'value'=>$profile->city->name,
                'id'=>'city',


                'clientOptions' => [
                    'source' => $city_list,
                    'autoFill'=>true,
                    'minLength' => 2,

                ],
                'options'=>[
                    'placeholder'=>'Отсутствует',
                    'data-old'=>$profile->city->name,
                    'readonly'=>true
                ]
            ])
            ?>
            <div class="pods fr">Город, к которому будет прикреплен ваш профиль</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="city">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="email">Email</label>
        </div>
        <div class="value-col ft">
            <input id="email" name="email" type="text" readonly value="<?=Html::encode($profile->email)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Контактный адрес электронной почты</div>
        </div>
        <div class="action-col">
            <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
        </div>
    </div>


    <?if (in_array($user->role->role_name, ['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_SUPPORT'])):?>
        <div class="row">
            <div class="label-col ft">
                <label for="experience">Experience</label>
            </div>
            <div class="value-col ft">
                <input id="experience" name="experience" type="text" readonly value="<?=Html::encode($profile->getExperience()->one()->experience)?>"
                       placeholder="Отсутствует"/>
                <div class="pods fr">Стаж работы по данной специальности</div>
            </div>
            <div class="action-col">
                <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
            </div>
        </div>
    <?endif;?>

    <div class="row">
        <div class="label-col ft">
            <label for="date_reg">Date registration</label>
        </div>
        <div class="value-col ft">
            <input id="date_reg" name="date_reg" type="text" readonly value="<?=Yii::$app->formatter->asDatetime($profile->created_at, "php:d.m.Y")?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr"></div>
        </div>
        <div class="action-col">
            <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
        </div>
    </div>

    <?if (User::checkRole(['ROLE_ADMIN'])):?>

        <div class="row">
            <div class="label-col ft">
                <label for="profile_date">Срок подписки</label>
            </div>
            <div class="value-col ft">
                <input id="profile_date" name="profile_date" type="text" readonly value="<?=$profile->chargeStatus==1?'Extended to '.Yii::$app->formatter->asDatetime($profile->chargeTill, "php:d.m.Y"):'Starting'?>"
                       placeholder="Отсутствует"/>
                <div class="pods fr"></div>
            </div>
            <div class="action-col">
                <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
            </div>
        </div>


    <?endif;?>

</div>

<script>
    $(document).ready(function() {
        $('[name=change]').click(function (e) {

            var el = e.target || e.srcElement;

            var prop = $(el).data('for');

            if ($('#' + prop).is('[readonly]')) {
                $('#' + prop).attr('readonly', false);
                $(el).html('Сохранить');

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
                $(el).html('Изменить');
            }
        });
    })
</script>