<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 26.02.18
 * Time: 1:39
 */

namespace frontend\models;


use common\models\Deal;
use common\models\NewTask;
use common\models\Profile;
use common\models\TaskComments;
use common\models\Tasks;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class TaskForm extends Model
{
    public $name;

    public $deal_id;

    public $manager_id;

    public $comment;


    public function rules()
    {
        return [
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['manager_id' => 'id']],
            [['name'], 'string', 'max' => 255],
            [['manager_id','name','comment'], 'required'],
            [['manager_id','deal_id'], 'integer'],
            [['comment'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'manager_id' => Yii::t('app', 'Manager'),
            'name' => Yii::t('app', 'Task Name'),
            'comment' => Yii::t('app', 'Task Comment'),
            'deal_id' => Yii::t('app', 'Deal'),

        ];
    }

    public function createTask()
    {
        $main_user = User::findOne(Yii::$app->user->id);
        $main_profile = $main_user->profile;
        $mail_account = $main_profile->account;




        if (!$this->validate()){
            return null;
        }
        $transaction = \Yii::$app->db->beginTransaction();

        try{

            if($this->deal_id){
                $deal = Deal::findOne($this->deal_id);
                if($deal->seller_id == $main_profile->id){
                    $deal->seller_id = $this->manager_id;
                    $deal->save();
                }
                elseif($deal->buyer_id == $main_profile->id){
                    $deal->buyer_id = $this->manager_id;
                    $deal->save();
                }
            }


            $task = new Tasks();
            $task_comment = new TaskComments();

            $task->date_created = date('Y-m-d H:i:s');
            $task->account_id = $mail_account->id;
            $task->deal_id = $this->deal_id;
            $task->task_name = $this->name;
            $task->manager_id = $this->manager_id;
            $task->save();


            $task_comment->task_id = $task->id;
            $task_comment->task_comment =  $this->comment;
            $task_comment->date_created =  $task->date_created;
            $task_comment->save();

            $new_task = new NewTask();
            $new_task->for_profile_id = $this->manager_id;
            $new_task->task_id = $task->id;
            $new_task->date_created = $task->date_created;
            $new_task->save();



            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            return null;
        }
    }


    public function editTask($id)
    {
        $main_user = User::findOne(Yii::$app->user->id);
        $main_profile = $main_user->profile;
        $mail_account = $main_profile->account;


        if (!$this->validate()){
            return null;
        }
        $transaction = \Yii::$app->db->beginTransaction();

        try{
            $task = Tasks::findOne($id);
            $task_comment = TaskComments::findOne(['task_id'=>$id]);

            $task->date_created = date('Y-m-d H:i:s');

           if($this->deal_id){
               $deal = Deal::findOne($this->deal_id);
               if($deal->seller_id == $main_profile->id){
                   $deal->seller_id = $this->manager_id;
                   $deal->save();
               }
               elseif($deal->buyer_id == $main_profile->id){
                   $deal->buyer_id = $this->manager_id;
                   $deal->save();
               }
           }
            else{
                if($task->deal_id){
                    $deal = Deal::findOne($task->deal_id);
                    if($deal->seller_id == $task->manager_id){
                        $deal->seller_id = $main_profile->id;
                        $deal->save();
                    }
                    elseif($deal->buyer_id == $task->manager_id){
                        $deal->buyer_id = $main_profile->id;
                        $deal->save();
                    }
                }

            }
            $task->deal_id = $this->deal_id;
            $task->task_name = $this->name;
            $task->manager_id = $this->manager_id;
            $task->save();


            $task_comment->task_comment =  $this->comment;
            $task_comment->date_created =  $task->date_created;
            $task_comment->save();

            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            return null;
        }
    }

}