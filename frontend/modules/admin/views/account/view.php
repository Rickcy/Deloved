<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Account */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            'org_form_id',
            'brand_name',
            'inn',
            'kpp',
            'legal_address',
            'date_reg',
            'phone1',
            'phone2',
            'fax',
            'web_address',
            'email:email',
            'description',
            'director',
            'work_time',
            'city_id',
            'address',
            'keywords',
            'public_status',
            'verify_status',
            'rating',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
