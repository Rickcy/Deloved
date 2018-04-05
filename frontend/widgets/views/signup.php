<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 14.08.17
 * Time: 12:42
 */
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\AutoComplete;
$session = Yii::$app->session;

if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
?>

<div class="modal fade" id="SignUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding: 0!important;overflow-x: hidden" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;min-width: 350px!important;">

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'],'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{hint}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
        ]]); ?>
        <h3 style="margin-bottom: 25px;font-weight: bold;text-align:center!important;color:rgb(148, 196, 61)">Регистрация
            <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
			width: 98%;
			height: 2px;"></div></h3>
        <div class="text-center">
            <h3 class="text_reg_1">Зарегистрируйтесь прямо сейчас и получите 2 недели
                бесплатной подписки</h3>
        </div>

        <!--<?/**= $form->field($model, 'fio')->textInput(['autofocus' => true])->label(Yii::t('app','Fio')) **/?>-->

        <?= $form->field($model, 'inn')->textInput(['maxlength' => 12,'placeholder'=>'Укажите ИНН вашей организации или ИП'])->label('ИНН')->hint('<a href="javascript:void(0)" id="InnWhy" >Почему мы просим указать ИНН?</a>')?>

        <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain'])->label(Yii::t('app','E-mail address')) ?>

        <?= $form->field($model, 'profile_city')->widget(
            AutoComplete::className(), [

            'clientOptions' => [
                'source' => $city_list,
                'minLength' => 2,
            ],
            'options'=>[
                'class'=>'form-control'
            ],
        ])->label(Yii::t('app','City'));
        ?>
        <div class="text-center">
            <h3 class="text_reg_1">Данные пользователя для авторизации</h3>
        </div>

        <?= $form->field($model, 'username')->textInput(['placeholder'=>Yii::t('app','The default email address is used')])->label(Yii::t('app','Enter login')) ?>

        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','Enter password')) ?>

        <?= $form->field($model,'repassword')->passwordInput()->label(Yii::t('app','Repeat password')) ?>


<div class="div_hidden" style="display: none;">
        <hr>
    <div class="text-center">
        <h3 class="text_reg_1">Данные предприятия/предпринимателя</h3>
    </div>
        <div class="signup_desc">Заполните поля в соответствии с данными ЕГРЮЛ/ЕГРИП. Обратите внимание на примеры </div>
        <?php $items = ArrayHelper::map($org_forms,'id','name');
        $params = [
            'prompt' => Yii::t('app','No select')
        ];
        echo $form->field($model, 'org_form_id')->dropDownList($items,$params)->label(Yii::t('app','Organizational and legal form'))?>

        <?= $form->field($model, 'full_name')->textInput()->label(Yii::t('app','Full name')) ?>

        <?= $form->field($model, 'brand_name')->textInput()->label(Yii::t('app','Brand name')) ?>



        <?= $form->field($model, 'ogrn')->textInput()->label(Yii::t('app','OGRN (OGRN)')) ?>



        <?= $form->field($model, 'legal_address')->textInput()->label(Yii::t('app','Legal address')) ?>

        <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
            DatePicker::className(), [
            'value' => '12/31/2010',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy',

            ]
        ])->label(Yii::t('app','Date registration'));?>


        <div class="col-sm-11 col-sm-offset-1">
            <div class="col-sm-8">
                <?= $form->field($model, 'city_name')->widget(
                    AutoComplete::className(), [

                    'clientOptions' => [
                        'source' => $city_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ],
                ])->label('Адрес офиса');
                ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'address')->textInput()->label('') ?>
            </div>

        </div>

        <?= $form->field($model, 'director')->textInput()->label(Yii::t('app','Director')) ?>

        <?= $form->field($model, 'phone1')->textInput()->label(Yii::t('app','Main number of phone')) ?>

        <?= $form->field($model, 'fax')->textInput()->label(Yii::t('app','Main number of fax')) ?>


        <?= $form->field($model, 'work_time')->textInput()->label(Yii::t('app','Work time')) ?>

        <?= $form->field($model, 'web_address')->textInput()->label('Web-site') ?>

        <?= $form->field($model, 'description')->textarea(['rows'=>6])->label(Yii::t('app','Description')) ?>

        <?= $form->field($model, 'keywords')->textarea(['rows'=>6])->label(Yii::t('app','Keywords')) ?>

        <?= $form->field($model, 'verifyUser')->hiddenInput(['value'=>0])->label('')?>
</div>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/front/captcha'])
        ])->label('') ?>

        <?=$form->field($model,'sogl')->checkbox(['class'=>'text-center'])->label(Html::a(Yii::t('app', 'I agree with the user agreement'), ['/front/sogl'],['target'=>'_blank']))?>

        <div class="form-group" style="text-align: right">
            <?= Html::submitButton(Yii::t('app','Complete registration'), ['class' => 'btn btn-md btn-success registr-btn','onclick'=>'yaCounter42521619.reachGoal("regzav"); return true; ', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end()?>


    </div>

</div>
<script>

    $(document).ready(function(){

            $('#SignUp').on('hidden.bs.modal', function (e) {
                $('#Questions').modal('show');

            });

        var len = null;
        $('#signupform-inn').focusout(function () {
            var inn = $(this).val();
            if ($(this).val().length === 10){
                len = 10;
                $.ajax({
                    type:'post',
                    url:'/main/get-date-by-inn-or-ogrn',
                    data:{'innOrOgrn':inn},
                    success:function (data) {
                        if (data['docs']) {
                            var div1 = $('<div>',{class:'form-group',style:'display:none'});
                            var div2 = $('<label>',{class:'col-sm-3 control-label'});
                            var div3 = $('<label>',{class:'col-sm-9'});
                            var ul = $('<select class="form-control change-comp" id="docs-list">');
                            ul.append('<option value="">Не выбрано</option>');
                            data['docs'].forEach(function (item, number) {
                                if(len === 12){
                                    if(item['ТипДокумента'] === 'ip'){
                                        ul.append('<option value="'+item['id']+'">ИП '+item['Фамилия']+'</option>')
                                    }
                                }
                                else if(len === 10){
                                    if(item['ТипДокумента'] === 'ul'){
                                        ul.append('<option value="'+item['id']+'">'+item['НаимЮЛСокр']+'</option>')
                                    }
                                }

                            });

                            div2.text('Выбирете компанию');
                            div1.append(div2);
                            div1.append(div3);
                            div3.append(ul);
                            $('.field-signupform-inn').after(div1);
                            console.log($('.change-comp option').length);
                            if($('.change-comp option').length === 2){
                                getDate($($('.change-comp option')[1]).attr('value'));
                            }
                            else{
                                div1.show();
                            }

                        }
                        else {
                            if (!data) {
                                $('.div_hidden').show();
                                return false;
                            }

                            if(data['Активность'] == 'Ликвидировано'){
                                showMessage('danger','Невозможно зарегистрировать компанию, т.к она ликвидирована')
                                $('.div_hidden').hide();
                                return false;
                            }

                            $('.div_hidden').hide();
                            console.log()
                            $.ajax({
                                type:'post',
                                url:'/main/many-comp?inn='+inn+'&ogrn='+data['ОГРН'],
                                success:function (many) {
                                    if(!many){
                                        $('#signupform-legal_address').val(data['Адрес']);
                                        $('#signupform-date').val(data['ДатаОГРН']);
                                        $('#signupform-full_name').val(data['НаимЮЛПолн']);
                                        $('#signupform-brand_name').val(data['НаимЮЛСокр']);
                                        $('#signupform-ogrn').val(data['ОГРН']);

                                        if(data['Руководители'][0]['fl']){
                                            $('#signupform-director').val(data['Руководители'][0]['fl']);
                                        }
                                        else{
                                            $('#signupform-director').val(data['СвУпрОрг'][0]['name']);
                                        }
                                        $('#signupform-description').val(data['НаимОКВЭД']);
                                        $('#signupform-verifyuser').val(1);
                                        if (data['НаимЮЛПолн'].indexOf('АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                                            $('#signupform-org_form_id').val(3)
                                        }
                                        if (data['НаимЮЛПолн'].indexOf('ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ') !== -1) {
                                            $('#signupform-org_form_id').val(2)
                                        }
                                        if (data['НаимЮЛПолн'].indexOf('ЗАКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                                            $('#signupform-org_form_id').val(5)
                                        }

                                        if (data['НаимЮЛПолн'].indexOf('ОТКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                                            $('#signupform-org_form_id').val(3)
                                        }
                                        if (data['НаимЮЛПолн'].indexOf('ПУБЛИЧНОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                                            $('#signupform-org_form_id').val(4)
                                        }
                                    }
                                    else{
                                        showMessage('danger','Невозможно зарегистрировать компанию, т.к она находится в реестре «Сведения о физических лицах, являющихся руководителями или учредителями (участниками) нескольких юридических лиц» (по данным ФНС)')
                                    }
                                },
                                error:function (err) {

                                }
                            });



                        }
                    },
                    error:function () {
                        $('.div_hidden').show();
                    }
                });
            }
            if ($(this).val().length === 12){
                len = 12;
                $.ajax({
                    type:'post',
                    url:'/main/get-date-by-inn-or-ogrn',
                    data:{'innOrOgrn':inn},
                    success:function (data) {

                        if (data['docs']) {
                            var div1 = $('<div>',{class:'form-group',style:'display:none'});
                            var div2 = $('<label>',{class:'col-sm-3 control-label'});
                            var div3 = $('<label>',{class:'col-sm-9'});
                            var ul = $('<select class="form-control change-comp" id="docs-list">');
                            ul.append('<option value="">Не выбрано</option>');
                            data['docs'].forEach(function (item, number) {
                                if(len === 12){
                                    if(item['ТипДокумента'] === 'ip'){
                                        ul.append('<option value="'+item['id']+'">ИП '+item['Фамилия']+'</option>')
                                    }
                                }
                                else if(len === 10){
                                    if(item['ТипДокумента'] === 'ul'){
                                        ul.append('<option value="'+item['id']+'">'+item['НаимЮЛСокр']+'</option>')
                                    }
                                }

                            });
                            div2.text('Выбирете компанию');
                            div1.append(div2);
                            div1.append(div3);
                            div3.append(ul);
                            $('.field-signupform-inn').after(div1);
                            console.log($('.change-comp option').length);
                            if($('.change-comp option').length === 2){
                                getDate($($('.change-comp option')[1]).attr('value'));

                            }
                            else{
                                div1.show();
                            }
                        }
                        else{
                               if (!data){
                                   $('.div_hidden').show();
                                   return false;
                               }
                                if(data['ДатаПрекращ'] != ''){
                                    showMessage('danger','Невозможно зарегистрировать ИП, т.к оно ликвидировано')
                                    $('.div_hidden').hide();
                                    return false;
                                }

                               $('.div_hidden').hide();

                               $('#signupform-legal_address').val(data['Адрес']);
                               $('#signupform-date').val(data['ДатаОГРНИП']);
                               $('#signupform-full_name').val(data['НаимВидИП']+' '+data['ФИО']);
                               $('#signupform-brand_name').val('ИП '+data['ФИО']);
                               $('#signupform-ogrn').val(data['ОГРНИП']);
                               $('#signupform-director').val(data['ФИО']);
                               $('#signupform-description').val(data['НаимОКВЭД']);
                               $('#signupform-org_form_id').val(1)
                               $('#signupform-verifyuser').val(1)
                           }
                    },
                    error:function () {
                        $('.div_hidden').show();
                    }
                });
            }
        });
        function showInfo(status, message){

            var ib = $('#flash-message');
            if ($.inArray(status, ['info', 'danger', 'warning', 'success']) != -1) {
                ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-'+status));
            } else {
                ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-info'));
            }

            ib.clearQueue();
            ib.stop();
            ib.hide();
            ib.html(message);
            ib.css({'top':'1%'})
            setTimeout(function(){
                ib.fadeIn(450);
                setTimeout(function(){
                    ib.fadeOut(22000, function() {
                    });
                    ib.mouseenter(function() {
                        ib.clearQueue();
                        ib.stop();
                        ib.animate({opacity: 1});
                    });
                    ib.mouseleave(function() {
                        ib.fadeOut(22000, function() {
                        });
                    });
                }, 12000)

            }, 100)
        }
        $(document).on('click','#InnWhy',function () {
            showInfo('info','Для нас важно, чтобы сообщество Деловед состояло из тех, кто заинтересован в честном ведении бизнеса, поэтому, по ИНН (идентификационный номер налогоплательщика), который является открытой информацией, система проведет идентификацию, и в случае если: компания или ИП прекратили деятельность, у компании есть признаки номинального руководства, компания не находится по адресу регистрации, то регистрация на Deloved.ru будет не возможна.\n\nБезопасные сделки на Deloved.ru только с проверенными контрагентами!')
        })

        $(document).on('change','#docs-list',function () {

            var value = $(this).val();

            getDate(value);

        });
        function showMessage(status, message, diraction = 5000){

            var ib = $('#flash-message');
            if ($.inArray(status, ['info', 'danger', 'warning', 'success']) != -1) {
                ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-'+status));
            } else {
                ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-info'));
            }

            ib.clearQueue();
            ib.stop();
            ib.hide();
            ib.html(message);

            setTimeout(function(){
                ib.fadeIn(450);
                setTimeout(function(){
                    ib.fadeOut(4000, function() {
                    });
                    ib.mouseenter(function() {
                        ib.clearQueue();
                        ib.stop();
                        ib.animate({opacity: 1});
                    });
                    ib.mouseleave(function() {
                        ib.fadeOut(8000, function() {
                        });
                    });
                }, 4000)

            }, 100)
        }
        function getDate(val) {
            console.log(val);
            if(!val){
                return false;
            }
            $.ajax({
                type:'post',
                data:{
                    'id':val
                },
                url:'/main/get-date-from-list',
                success:function (data) {
                    if(len === 10){
                        if(data['Активность'] == 'Ликвидировано'){
                            showMessage('danger','Невозможно зарегистрировать компания, т.к она ликвидирована');
                            $('.div_hidden').hide();
                            return false;
                        }
                        $('#signupform-legal_address').val(data['Адрес']);
                        $('#signupform-date').val(data['ДатаОГРН']);
                        $('#signupform-full_name').val(data['НаимЮЛПолн']);
                        $('#signupform-brand_name').val(data['НаимЮЛСокр']);
                        $('#signupform-ogrn').val(data['ОГРН']);
                        $('#signupform-director').val(data['Руководители'][0]['fl']);
                        $('#signupform-description').val(data['НаимОКВЭД']);
                        $('#signupform-verifyuser').val(1);
                        if (data['НаимЮЛПолн'].indexOf('АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                            $('#signupform-org_form_id').val(3)
                        }
                        if (data['НаимЮЛПолн'].indexOf('ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ') !== -1) {
                            $('#signupform-org_form_id').val(2)
                        }
                        if (data['НаимЮЛПолн'].indexOf('ЗАКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                            $('#signupform-org_form_id').val(5)
                        }

                        if (data['НаимЮЛПолн'].indexOf('ОТКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                            $('#signupform-org_form_id').val(3)
                        }
                        if (data['НаимЮЛПолн'].indexOf('ПУБЛИЧНОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО') !== -1) {
                            $('#signupform-org_form_id').val(4)
                        }
                    }
                    else if(len === 12){
                        if(data['Активность'] == 'Ликвидировано'){
                            showMessage('danger','Невозможно зарегистрировать компания, т.к она ликвидирована');
                            $('.div_hidden').hide();
                            return false;
                        }
                        $('#signupform-legal_address').val(data['Адрес']);
                        $('#signupform-date').val(data['ДатаОГРНИП']);
                        $('#signupform-full_name').val(data['НаимВидИП']+' '+data['ФИО']);
                        $('#signupform-brand_name').val('ИП '+data['ФИО']);
                        $('#signupform-ogrn').val(data['ОГРНИП']);
                        $('#signupform-director').val(data['ФИО']);
                        $('#signupform-description').val(data['НаимОКВЭД']);
                        $('#signupform-org_form_id').val(1)
                        $('#signupform-verifyuser').val(1)
                    }
                }
            });
        }
    });
</script>