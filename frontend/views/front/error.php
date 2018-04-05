<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $message;
if(Yii::$app->user->isGuest){
    $this->context->layout ='/front';
}
else{
    $this->context->layout ='/admin';
}
?>


    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>




