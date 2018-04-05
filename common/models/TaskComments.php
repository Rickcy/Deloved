<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_comments".
 *
 * @property integer $id
 * @property integer $task_id
 * @property string $task_comment
 * @property string $date_created
 *
 *
 * @property Tasks $task
 */
class TaskComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'task_comment'], 'required'],
            [['task_id'], 'integer'],
            [['task_comment'], 'string'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'task_comment' => Yii::t('app', 'Task Comment'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    public function getTask(){
        return $this->hasOne(Tasks::className(),['id'=>'task_id' ]);
    }
}
