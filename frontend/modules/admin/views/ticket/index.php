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
$this->title = Yii::t('app', 'Support');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="tickets-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create a support appeal'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                    <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Предприятие')?></td>


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
                <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>

                        <td>
                            <?= $ticket->id ?>

                        </td>

                    <td class="ticket-<?=$ticket->id?>">
                        <?php if ($ticket->profile->account):?>
                        <?= Html::a($ticket->profile->account->brand_name, ['show', 'id' => $ticket->id]) ?>
                        <?php else:?>
                        <?= Html::a($ticket->profile->fio, ['show', 'id' => $ticket->id]) ?>
                        <?php endif;?>
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
