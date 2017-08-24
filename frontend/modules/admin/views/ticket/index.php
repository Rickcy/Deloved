<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.08.17
 * Time: 15:08
 */
use common\models\Ticket;
use common\models\User;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="tickets-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create ticket'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                    <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Name')?></td>


                <td><?=Yii::t('app', 'Status')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>

            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            /**
             * @var $ticket \common\models\Ticket
             */
            foreach ($tickets as $ticket):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                        <td>
                            <?= $ticket->id ?>

                        </td>

                    <td>
                        <?= Html::a($ticket->name, ['update', 'id' => $ticket->id]) ?>

                    </td>
                    <td>
                        <?= Ticket::getNameStatus($ticket->status) ?>
                    </td>

                    <td><?=(new DateTime($ticket->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>


                </tr>
                <?php
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
