<?php

/**
 * @var $task \common\models\Tasks
 */

use common\models\User;
use yii\bootstrap\Html;
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">
    <h3><?=$this->title?></h3>
    <?php if(User::checkRole(['ROLE_USER']) &&  !(User::findOne(Yii::$app->user->id))->profile->isManager()):?>
    <p>
        <?= Html::a(Yii::t('app', 'Create task'), ['create-task'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Task Name')?></td>


                <td><?=Yii::t('app', 'Tasks for Deal')?></td>
                <td><?=Yii::t('app', 'Status')?></td>

                <td>Дата добавления|измнения</td>
                <?php if(User::checkRole(['ROLE_USER']) &&  !(User::findOne(Yii::$app->user->id))->profile->isManager()):?>
                <td><?=Yii::t('app', 'Manager')?></td>

                <td></td>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($tasks as $task):?>
                <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>

                    <td class="task-<?=$task->id?>">
                        <a href="/admin/crm/task?id=<?=$task->id ?>"><?=$task->task_name ?></a>

                    </td>


                    <td ><?=$task->deal_id ? '<a href="/admin/deal/show?id='.$task->deal->id.'">'.$task->deal->buyer->account->brand_name.' && '.$task->deal->seller->account->brand_name.'</a>':'Нет'?></td>

                    <td><?=\common\models\Tasks::getNameStatus($task->status)?></td>

                    <td>
                        <?=(new DateTime(Yii::$app->formatter->asDatetime($task->date_created, "php:Y-m-d  H:i")))->add(new DateInterval('PT'.$timeZone.'H'))->format('d.m.Y H:i')?>
                    </td>

                <?php if(User::checkRole(['ROLE_USER']) &&  !(User::findOne(Yii::$app->user->id))->profile->isManager()):?>
                    <td>
                        <?=$task->manager->fio?>
                    </td>

                    <td>
                        <?= Html::a('', ['delete-task', 'id' => $task->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],])?>

                    </td>
                <?php endif;?>
                </tr>
                <?php
                $i++;
            endforeach;?>

            </tbody>
        </table>
    </div>

</div>
