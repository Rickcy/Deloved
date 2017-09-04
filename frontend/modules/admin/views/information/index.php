<?php
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Extended validation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-index">
    <div class="col-xs-12">
    <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="col-xs-12">
        <div class="row">

            <div class="col-xs-7 text-left">
                <input type="text" class="form-control" placeholder="Введите ИНН">
            </div>
        </div>
        <button class="btn btn-success btn-md" type="button">Проверить</button>
    </div>
</div>
