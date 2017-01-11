<?php
/* @var $this yii\web\View */
/* @var $condition common\models\Condition */
/* @var $deliveryMethod common\models\DeliveryMethods */
use common\models\User;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Additional');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
Yii::$app->formatter->timeZone = 'UTC';
?>
<div class="additional-index">
    <div class="condition-list">

        <h3><?= Yii::t('app', 'Condition good') ?></h3>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create Condition'), ['create-condition'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="table-responsive">
            <table border="0" class="table table-striped">
                <thead class="thead-main">
                <tr>


                    <td><?=Yii::t('app', 'Name')?></td>

                        <td></td>

                </tr>
                </thead>
                <tbody>
                <?
                $i=0;
                foreach ($conditions as $condition):?>
                    <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                        <td>
                            <?= Html::a($condition->name, ['update', 'id' => $condition->id]) ?>
                        </td>

                        <td>
                            <?= Html::a('', ['delete-condition', 'id' => $condition->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this condition?'),
                                'method' => 'post',
                            ],])?>

                        </td>

                    </tr>
                    <?
                    $i++;
                endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="delivery-methods-list">

    <h3><?= Yii::t('app', 'Delivery methods') ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Delivery method'), ['create-delivery-methods'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>

                <td></td>

            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($deliveryMethods as $deliveryMethod):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= Html::a($deliveryMethod->name, ['update', 'id' => $deliveryMethod->id]) ?>
                    </td>

                    <td>
                        <?= Html::a('', ['delete-delivery-method', 'id' => $deliveryMethod->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this delivery method?'),
                            'method' => 'post',
                        ],])?>

                    </td>

                </tr>
                <?
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
    <br>
    <hr>
    <br>
    <div class="pay-methods-list">

    <h3><?= Yii::t('app', 'Payment methods') ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Payment methods'), ['create-pay-methods'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>

                <td></td>

            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($payMethods as $payMethod):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= Html::a($payMethod->name, ['update', 'id' => $payMethod->id]) ?>
                    </td>

                    <td>
                        <?= Html::a('', ['delete-pay-method', 'id' => $payMethod->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this payment method?'),
                            'method' => 'post',
                        ],])?>

                    </td>

                </tr>
                <?
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!--Новый-->
<!--Восстановлен производителем-->
<!--Восстановлен продавцом-->
<!--Б/у-->
<!--Для разборки на запчасти или в нерабочем состоянии-->
<!---->
<!---->
<!--Самовывоз-->
<!--Курьерская доставка-->
<!--Отправка почтой-->
<!--Доставка транспортной компанией-->
<!---->
<!---->
<!--Платеж наличными-->
<!--Безналичный расчет -->

