<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 26.09.17
 * Time: 12:21
 */

namespace frontend\widgets;


use common\models\Category;
use common\models\CategoryType;
use common\models\User;
use yii\bootstrap\Widget;

class ChangeCategory extends Widget
{
    public $isItem;
    public $urlRed;
    public function run()
    {
        $account=User::findOne(\Yii::$app->user->id)->profile->account;
        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();
        $myCategory =$account->category;

        return $this->render('category',['category'=>$category,'categoryType'=>$categoryType, 'myCategory'=>$myCategory,'urlRed'=>$this->urlRed,'item'=>$this->isItem]);


    }


}