<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 03.10.17
 * Time: 17:14
 */

namespace frontend\widgets;


use common\models\Review;
use common\models\User;
use Yii;
use yii\bootstrap\Widget;

class ReviewsWidget extends Widget
{
    public $account;
    public function run()
    {

        $reviews = Review::find()->where(['about_id'=>$this->account->id])->andWhere(['published'=>true])->all();

        return $this->render('reviews',['reviews'=>$reviews,'acc'=>$this->account]);
    }

}