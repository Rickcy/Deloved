<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
/**@var $account common\models\Account**/
/**@var $image common\models\Logo**/
$image =$account->getMainImage();
?>
<div class="profile-info">



    <h2 class="ft">Общая информация</h2>

    <div class="row">
        <div class="label-col ft">
            <label for="id">ID в системе</label>
        </div>
        <div class="value-col ft">
            <p id="id" name="id"><?=Html::encode($account->id)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="orgForm">Организационно-правовая форма</label>
        </div>
        <div class="value-col ft">
            <p id="orgForm" name="orgForm"><?=Html::encode($account->orgForm->name)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="fullName">Полное наименование</label>
        </div>
        <div class="value-col ft">
            <p id="fullName" name="fullName"><?=Html::encode($account->full_name)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>



    <div class="row">
        <div class="label-col ft">
            <label for="brandName">Фирменное наименование</label>
        </div>
        <div class="value-col ft">
            <p id="brandName" name="brandName"><?=Html::encode($account->brand_name)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">

            <label>Логотип</label>
        </div>
        <div class="value-col ft">
            <div name="logo">
                <img src="<?=Html::encode($image->file)?>" class="img-thumbnail" alt="<?=Html::encode($image->image_name)?>">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($logo, 'image_file')->fileInput()->label('') ?>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
        <div class="action-col ft">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="rating">Деловая репутация</label>
        </div>
        <div class="value-col">
            <p id="rating" name="rating"><?=Html::encode($account->rating)?>%</p>
        </div>

    </div>


    <hr>



    <h2 class="ft">Юридическая информация</h2>

    <div class="row">
        <div class="label-col ft">
            <label for="inn">ИНН</label>
        </div>
        <div class="value-col ft">
            <p id="inn" name="inn"><?=Html::encode($account->inn)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="regNumber">ОГРН</label>
        </div>
        <div class="value-col ft">
            <p id="regNumber" name="regNumber"><?=Html::encode($account->ogrn)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>


    <div class="row">
        <div class="label-col ft">
            <label for="legalAddress">Юридический адрес</label>
        </div>
        <div class="value-col ft">
            <p id="legalAddress" name="legalAddress"><?=Html::encode($account->legal_address)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="regDate">Дата регистрации</label>
        </div>
        <div class="value-col ft">
            <p id="regDate" name="regDate"><?=Html::encode($account->date_reg)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="manager">Руководство</label>
        </div>
        <div class="value-col ft">
            <p id="manager" name="manager"><?=Html::encode($account->director)?></p>
        </div>
        <div class="action-col">
        </div>
    </div>


    <hr>

    <h2 class="ft">Контактная информация</h2>

    <div class="row">
        <div class="label-col ft">
            <label for="city">Фактический город</label>
        </div>
        <div class="value-col ft">
            <input id="city" name="city" type="text" readonly value="<?=Html::encode($account->city->name)?>" data-old="<?=Html::encode($account->city->name)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Город вашего центрального офиса</div>
        </div>

        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="city">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="address">Фактический адрес</label>
        </div>
        <div class="value-col ft">
            <input id="address" name="address" type="text" readonly value="<?=Html::encode($account->address)?>" data-old="<?=Html::encode($account->address)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес вашего центрального офиса</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="address">Изменить</a>
            <!--a href="javascript:void(0)">Показать на карте</a-->
            <a id="ancorShow" href="#" onclick="mapToolBarShow();return false;">Показать карту</a>
            <a id="ancorHide" href="#" onclick="mapToolBarHide();return false;" style="display:none;">Скрыть карту</a>
        </div>
    </div>



    <div id="mapToolBar" style="display:block;" align="center">
        <div id="map" style="width:500px; height:500px; display: none; margin: 15px"></div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="email">Email</label>
        </div>
        <div class="value-col ft">
            <input id="email" name="email" type="text" readonly value="<?=Html::encode($account->email)?>" data-old="<?=Html::encode($account->email)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес электронной почты</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="web_address">Сайт</label>
        </div>
        <div class="value-col ft">
            <input id="web_address" name="web_address" type="text" readonly value="<?=Html::encode($account->web_address)?>" data-old="<?=Html::encode($account->web_address)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес веб-сайта</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="web_address">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="phone1">Номер телефона №1</label>
        </div>
        <div class="value-col ft">
            <input id="phone1" name="phone1" type="text" readonly value="<?=Html::encode($account->phone1)?>" data-old="<?=Html::encode($account->phone1)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Основной номер телефона</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="phone1">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="phone2">Номер телефона №2</label>
        </div>
        <div class="value-col ft">
            <input id="phone2" name="phone2" type="text" readonly value="<?=Html::encode($account->phone2)?>" data-old="<?=Html::encode($account->phone2)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Дополнительный номер телефона</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="phone2">Изменить</a>
        </div>
    </div>



    <div class="row">
        <div class="label-col ft">
            <label for="fax">Факс</label>
        </div>
        <div class="value-col ft">
            <input id="fax1" name="fax" type="text" readonly value="<?=Html::encode($account->fax)?>" data-old="<?=Html::encode($account->fax)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Номер факса</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="fax">Изменить</a>
        </div>
    </div>


    <hr>


    <h2 class="ft">Дополнительная информация</h2>

    <div class="row">
        <div class="label-col ft">
            <label for="work_time">Время работы</label>
        </div>
        <div class="value-col ft">
            <input id="workTime" name="work_time" type="text" readonly value="<?=Html::encode($account->work_time)?>" data-old="<?=Html::encode($account->work_time)?>"
                   placeholder="Отсутствует"/>
            <div class="pods fr">В свободной форме укажите график работы</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="work_time">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="description">Описание</label>
        </div>
        <div class="value-col ft">
                <textarea id="description" name="description" type="text" readonly data-old="<?=Html::encode($account->description)?>"
                          placeholder="Отсутствует"><?=Html::encode($account->description)?>
                </textarea>
            <div class="pods fr">Краткое описанеи вашей деятельности, основые направления деятельности, предлагаемые товары и услуги.</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="description">Изменить</a>
        </div>
    </div>

    <div class="row">
        <div class="label-col ft">
            <label for="keywords">Ключевые слова</label>
        </div>
        <div class="value-col ft">
                <textarea id="keywords" name="keywords" type="text" readonly data-old="<?=Html::encode($account->keywords)?>"
                          placeholder="Отсутствуют"><?=Html::encode($account->keywords)?>
                </textarea>
            <div class="pods fr">Укажите через запятые набор слов наиболее полно отражающих вашу деятельности.
                Ключевые слова используются для более эффективного поиска вашего предприятия</div>
        </div>
        <div class="action-col">
            <a href="javascript:void(0)" name="change" data-for="keywords">Изменить</a>
        </div>
    </div>
    <hr>



</div>
<script>
    $(document).ready(function() {

            var value =$("#logo-image_file");
            value.change(function () {
                console.log(value.val());
                $.ajax({
                    type: 'POST',
                    url: "/admin/account/file-upload-general",
                    success: function (data, textStatus) {

                        console.log(data)

                    },
                    error:function (XMLHttpRequest, textStatus, errorThrown) {

                        console.log(errorThrown)
                    }
                })

            });

        $('[name=change]').click(function(e) {

            var el = e.target || e.srcElement;

            var prop = $(el).data('for');

            if ($('#'+prop).is('[readonly]')) {
                $('#'+prop).attr('readonly', false);
                $(el).html('Сохранить');

            } else {
                var oldValue = $('#'+prop).data('old');
                var newValue = $('#'+prop).val();
                if (oldValue != newValue) {

                    $.ajax({
                        type: 'POST',
                        url: "/admin/account/edit-new/?value="+newValue+'&prop='+prop,

                        beforeSend: function() {
                            $('#'+prop+'spinner').show();
                        },
                        complete: function (textStatus) {
                            $('#'+prop+'spinner').hide();
                            if (textStatus.status) {

                            } else {

                            }
                        },
                        success: function (data, textStatus) {
                            var obj = $.parseJSON(data);


                            if (obj.success) {
                                $('#'+prop).data('old', newValue);

                            } else {
                                $('#'+prop).val(oldValue);
                            }
                            showMessage('success', obj.success)
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showMessage('danger', 'Ошибка соединения');
                            console.log('Ошибка соединения')
                        }
                    })
                }
                $('#'+prop).attr('readonly', true);
                $(el).html('Изменить');
            }
        });
    });
</script>