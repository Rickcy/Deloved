<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Подача иска');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Claim'), 'url' => ['index']];
?>
<div id="create-claim" role="main">
    <div class=lead>Иск к предприятию:  <a href="/companies/item?id=<?=$partner->account->id?>"><?=$partner->account->brand_name?></a></div>


    <div class="col-sm-12" style="padding:10px">
        <ul  style="list-style:none;padding-left: 0">
            <li style="padding: 5px;font-size: 12pt"><img style="width: 6%;margin-left: 16px;margin-right: 14px" src="/images/admin/sud_ultra.png"/>При подаче иска вы всегда можете воспользоваться
                <a target="_blank" href="/admin/consult/create">помощью юриста</a> </li>
            <li style="padding: 5px;font-size: 12pt"><img style="width: 5%;margin-left: 20px;margin-right: 18px" src="/images/admin/hammer.png"/>Иск будет рассмотрен в <a target="_blank" href="http://delovedsud.ru">Третейском суде "Деловед"</a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="info"  style="padding:10px;">Опишите в текстовом поле кратко суть иска.</div>
    <div class="claim-create">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-2 control-label">{label}</div><div class="col-sm-6">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
        ]]); ?>

        <?= $form->field($claim, 'detailText')->textarea(['rows'=>5,'maxlength'=>255])->label(Yii::t('app','Detail subscribe')) ?>
        <hr>

        <div class="col-sm-12" style="padding: 15px;font-size: 12pt">
            <h4>Прикрепите копии следующих документов</h4>
            <table class="table table-responsive table-bordered">
                <tbody>
                    <tr>
                        <td>Исковое заявление</td>
                        <td class="text-center">
                            <?= Html::button( Yii::t('app', 'Attach file') , ['class' =>  'noFileClaim btn create-btn btn-xs btn-success' ]) ?>
                            <?= $form->field($claim, 'claimFile')->fileInput(['class'=>'hidden','claim-id'=>$claim->id,'id'=>'claim-file'])->label('');?>
                        </td>
                        <td class="text-center" id="claim-result" style="vertical-align: middle">
                            <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Документ об оплате третейского сбора(<a target="_blank" href="http://delovedsud.ru/treteiski-sbor/calculator.php">Расчет третейского сбора</a>)</td>
                        <td class="text-center" >
                            <?= Html::button( Yii::t('app', 'Attach file') , ['class' =>  'noFileSud btn create-btn btn-xs btn-success' ]) ?>
                            <?= $form->field($claim, 'claimSudFile')->fileInput(['class'=>'hidden','claim-sud-id'=>$claim->id,'id'=>'claim-sud-file'])->label('');?>
                        </td>
                        <td class="text-center " id="claim-sud-result" style="vertical-align: middle">
                            <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Договор или соглашение, содержащие <a target="_blank" href="http://delovedsud.ru/appeal/">третейскую оговорку</a></td>
                        <td class="text-center ">

                            <?= Html::button( Yii::t('app', 'Attach file') , ['class' =>  'noFileOgovor btn create-btn btn-xs btn-success' ]) ?>
                            <?= $form->field($claim, 'claimOgovorFile')->fileInput(['class'=>'hidden','claim-ogovor-id'=>$claim->id,'id'=>'claim-ogovor-file'])->label('');?>
                        </td>
                        <td class="text-center " id="claim-ogovor-result" style="vertical-align: middle">
                            <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <div class="form-group text-left" style="margin-left: 15px">
            <?= Html::submitButton( Yii::t('app', 'Create') , ['disabled'=>'disabled','class' =>  'btn create-btn btn-md btn-success create-claim' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), '/admin/deal/show?id='.$deal->id,['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<script>
    $(document).ready(function () {
        var claimResult,claimSudResult,claimOgovorResult;
        $('.noFileClaim').click(function () {
            $('#claim-file').click();
        });
        $('.noFileSud').click(function () {
            $('#claim-sud-file').click();
        });
        $('.noFileOgovor').click(function () {
            $('#claim-ogovor-file').click();
        });
        $('#claim-file').change(function () {
            claimResult =true;
            $('#claim-result').children().remove();
            $('#claim-result').append('<span style="font-size: 1.4em;color: green;" class="glyphicon glyphicon-ok"></span>');
            isResult()
        });
        $('#claim-sud-file').change(function () {
            claimSudResult =true;
            $('#claim-sud-result').children().remove();
            $('#claim-sud-result').append('<span style="font-size: 1.4em;color: green;" class="glyphicon glyphicon-ok"></span>');
            isResult()
        });
        $('#claim-ogovor-file').change(function () {
            claimOgovorResult =true;
            $('#claim-ogovor-result').children().remove();
            $('#claim-ogovor-result').append('<span style="font-size: 1.4em;color: green;" class="glyphicon glyphicon-ok"></span>');
            isResult()
        });

        function isResult() {
            if(claimResult == true && claimSudResult == true && claimOgovorResult == true){
                $('.create-claim').removeAttr('disabled')
            }
          }
    })

</script>