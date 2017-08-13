<?php
/* @var $this yii\web\View */
/* @var $suggestion common\models\Suggestion */
use common\models\User;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Contact us');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="suggestion-list">
    <h3><?= Html::encode($this->title) ?></h3>
    <hr>
    <?php foreach ($suggestions as $suggestion):?>
        <div class="table-responsive">
            <div style="margin: 10px 10px 10px 0; border: 1px solid silver; background-color: #f2f2f2; padding: 10px; border-radius: 4px">

                <div class="row">
                    <div class="col-md-6" align="left">
                       <?=$suggestion->sugCategory->name?>
                    </div>
                    <div class="col-md-6" align="right">
                        <?=Yii::$app->formatter->asDatetime($suggestion->date_published, "php:d.m.Y H:i:s");?>
                        <br><br>
                        <?= Html::a('', ['sug-delete', 'id' => $suggestion->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this suggestion?'),
                            'method' => 'post',
                        ],])?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                       <?=$suggestion->content?>
                    </div>
                </div>

                <div class="row" align="right">
                    <div class="col-md-12">
                        <?=$suggestion->author->fio?>
                    </div>
                </div>

            </div>
        </div>
    <?php endforeach;?>
</div>
