<?php


use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
$this->title = Yii::t('app', 'Create task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php if(User::checkRole(['ROLE_USER']) &&  !(User::findOne(Yii::$app->user->id))->profile->isManager()):?>
<div class="task-create">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
    ]]); ?>

    <?= $form->field($model, 'name')->textInput(['value'=>$task->task_name]) ?>

    <?php  $items = ArrayHelper::map($managers,'id','fio');
    $params = [
        'prompt' => 'Выбирете менеджера',
        'value'=>$task->manager_id
    ];
    echo $form->field($model, 'manager_id')->dropDownList($items,$params)?>

    <?php
    $data = ArrayHelper::toArray($deals, [
        'common\models\Deal' => [
            'id',
            'name' => function ($deal) {
                return $deal->buyer->account->brand_name.' && '.$deal->seller->account->brand_name;
            },
        ],
    ]);
    $items = ArrayHelper::map($data,'id','name');
    $params = [
        'prompt' => 'Выбирете Сделку',
        'value'=>$task->deal_id
    ];
    echo $form->field($model, 'deal_id')->dropDownList($items,$params)?>


    <?= $form->field($model, 'comment')->textarea(['rows'=>6,'value'=>$task_comment->task_comment]) ?>
    <div class="row">
        <div class="col-sm-3 control-label">Статус задачи</div>
        <div class="col-sm-5">
            <button type="button" class="btn btn-primary"><?=\common\models\Tasks::getNameStatus($task->status)?></button>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create task'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php else:?>
    <div class="task-create">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-3 control-label">Название задачи</div>
                <div class="col-sm-3 "><?=Html::encode($task->task_name)?></div>
            </div>
        </div>
        <br>
        <?php if($task->deal_id):?>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-3 control-label">Сделка по задаче</div>
                <div class="col-sm-3 "><a href="/admin/deal/show?id=<?=$task->deal_id?>"><?=$task->deal->buyer->account->brand_name.' && '.$task->deal->seller->account->brand_name?></a></div>
            </div>
        </div>
        <br>
        <?php endif;?>
        <div class="row">
        <div class="col-xs-12">
            <div class="col-sm-3 control-label">Дата добавления|изменения</div>
            <div class="col-sm-3"><?=(new DateTime(Yii::$app->formatter->asDatetime($task->date_created, "php:Y-m-d  H:i")))->add(new DateInterval('PT'.$timeZone.'H'))->format('d.m.Y H:i')?></div>
        </div>
        </div>
        <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-sm-3 control-label">Коментарий к задаче</div>
            <div class="col-sm-3"><?=Html::encode($task_comment->task_comment)?></div>
        </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-3 control-label">Статус задачи</div>
                <div class="col-sm-5">

                    <button type="button" id="status-<?=$task->status?>" class="btn btn-primary disabled"><?=\common\models\Tasks::getNameStatus($task->status)?></button>
                    <?php if (\common\models\Tasks::getNextStatus($task->status)):?>
                    <span id="ch">сменить на</span> <button onclick='function changeStatusTask(id,task) {
                            $.ajax({type:"post",url:"/admin/crm/change-status",data:{id:id,task:task},success:function() {
                                var id_prev = id - 1;
                                $("#status-"+id_prev).remove()
                                $("#ch").remove();
                            $("#status-"+id).attr("disabled");
                            }})
                            }
                            changeStatusTask(<?=\common\models\Tasks::getNextStatus($task->status)?>,<?=$task->id?>)'  id="status-<?=common\models\Tasks::getNextStatus($task->status)?>" type="button" class="btn btn-success"><?=\common\models\Tasks::getNameStatus(\common\models\Tasks::getNextStatus($task->status))?></button>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>