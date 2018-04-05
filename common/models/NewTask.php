<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_task".
 *
 * @property integer $id
 * @property integer $for_profile_id
 * @property integer $task_id
 * @property string $date_created
 *
 *
 * @property Profile $manager
 * @property Tasks $task
 */
class NewTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['for_profile_id', 'task_id'], 'required'],
            [['for_profile_id', 'task_id'], 'integer'],
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
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }


    public function getManager(){
        return $this->hasOne(Profile::className(),['id'=>'for_profile_id' ]);
    }

    public function getTask(){
        return $this->hasOne(Tasks::className(),['id'=>'task_id' ]);
    }

}
