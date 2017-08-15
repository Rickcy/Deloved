<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 11.01.2017
 * Time: 11:20
 */

namespace frontend\models;


use common\models\NewSuggestion;
use common\models\Profile;
use common\models\Role;
use common\models\Suggestion;
use common\models\User;
use Yii;
use yii\base\Exception;
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

    public function attributeLabels()
    {
        return[
            'suggestion_cat'=>Yii::t('app', 'Theme'),
            'content'=>Yii::t('app', 'Message Area'),
        ];
    }


    public function createSug(){
        if (!$this->validate()){
            return null;
        }
        $user = User::findOne(Yii::$app->user->id);
        $suggestion = new Suggestion();
        $suggestion->content =$this->content;
        $suggestion->date_published = date('Y-m-d H:i');
        $suggestion->sug_category_id =$this->suggestion_cat;
        $suggestion->author_id =$user->profile->id;

        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $suggestion->save();
            $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id)';
            $profile_managers = Yii::$app->db->createCommand($query,[
                ':role_id'=>ROLE::ROLE_MANAGER
            ])->queryAll();


            $new_suggestion = new NewSuggestion();
            $new_suggestion->for_profile_id = Profile::ID_PROFILE_ADMIN;
            $new_suggestion->new_suggestion_id = $suggestion->id;
            $new_suggestion->date_created = date('Y-m-d H:i');
            $new_suggestion->save();

            foreach ($profile_managers as $profile){
                $new_suggestion = new NewSuggestion();
                $new_suggestion->for_profile_id = $profile['id'];
                $new_suggestion->new_suggestion_id = $suggestion->id;
                $new_suggestion->date_created = date('Y-m-d H:i');
                $new_suggestion->save();

            }
            $transaction->commit();
            return true;
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->session->addFlash('success', $e->getMessage());
            Yii::$app->controller->redirect(['index']);
        }


    }


}