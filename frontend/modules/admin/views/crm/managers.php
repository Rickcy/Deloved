<?php


use yii\bootstrap\Html;

/**
 * @var $manager \common\models\Managers
 */
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
$this->title = Yii::t('app', 'Managers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="managers-index">
    <h3><?=$this->title?></h3>
    <p>
        <?= Html::a(Yii::t('app', 'Create manager'), ['create-manager'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Fio')?></td>

                <td><?=Yii::t('app', 'City')?></td>

                <td>Дата добавления</td>
                <td><?=Yii::t('app', 'Online')?></td>

                    <td></td>

            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($managers as $manager):
                $profile = $manager->profile;
                ?>
                <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>

                    <td class="profile-<?=$profile->id?>">
                        <?=$profile->fio ?>
                    </td>


                    <td id="gridRow<?=$profile->id?>city"><?=$profile->city_id?$profile->city->name:''?></td>
                    <td>
                        <?=(new DateTime(Yii::$app->formatter->asDatetime($profile->created_at, "php:Y-m-d  H:i")))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>
                    <td>
                    <?=$profile->user->online?'Да':'Нет'?>
                    </td>

                        <td>
                            <?= Html::a('', ['delete-manager', 'id' => $manager->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],])?>

                        </td>

                </tr>
                <?php
                $i++;
            endforeach;?>

            </tbody>
        </table>
    </div>


</div>
