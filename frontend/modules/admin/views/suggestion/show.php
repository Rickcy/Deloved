<?php
/* @var $this yii\web\View */
use common\models\User;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Contact us');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="suggestion-list">
    <h3><?= Html::encode($this->title) ?></h3>


</div>
