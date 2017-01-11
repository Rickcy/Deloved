<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 11.01.2017
 * Time: 11:20
 */

namespace frontend\models;


use common\models\Suggestion;
use common\models\User;
use Yii;
use yii\base\Model;

class SuggestionForm extends Model
{

   
    public $content;
    public $suggestion_cat;

    public function rules()
    {

        return [
            [['content','suggestion_cat'],'required'],
            ['content','string','max' => 1165],
            ['suggestion_cat','integer']
        ];

    }

    public function createSug(){
        if (!$this->validate()){
            return null;
        }
        $user = User::findOne(Yii::$app->user->id);
        $suggestion = new Suggestion();
        $suggestion->title =$this->title;
        $suggestion->content =$this->content;
        $suggestion->date_published =time();
        $suggestion->sug_category_id =$this->suggestion_cat;
        $suggestion->author_id =$user->getProfile()->one()->id;
        $suggestion->save();
        if ($suggestion->save()){
            return true;
        }
    }


}