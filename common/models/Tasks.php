<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property integer $account_id
 * @property integer $deal_id
 * @property integer $status
 * @property string $task_name
 * @property string $date_created
 *
 * @property Profile $manager
 * @property Account $account
 * @property Deal $deal
 */
class Tasks extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_SUCCESS = 2;


    public static function getNameStatus($status)
    {
        $statuses =[
            self::STATUS_NEW =>'Новая',
            self::STATUS_IN_PROGRESS =>'В прогрессе',

            self::STATUS_SUCCESS =>'Выполнена',
        ];
        return $statuses[$status];
    }

    public static function getNextStatus($status)
    {
        $statuses =[
            self::STATUS_NEW =>self::STATUS_IN_PROGRESS,
            self::STATUS_IN_PROGRESS =>self::STATUS_SUCCESS,
            self::STATUS_SUCCESS=>false

        ];
        return $statuses[$status];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id','account_id', 'task_name'], 'required'],
            [['manager_id','account_id', 'deal_id','status'], 'integer'],
            [['date_created'], 'safe'],
            [['task_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'manager_id' => Yii::t('app', 'Manager ID'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'task_name' => Yii::t('app', 'Task Name'),
            'date_created' => Yii::t('app', 'Date Created'),
            'status' => Yii::t('app', 'Status'),
        ];
    }



    public function getManager(){
        return $this->hasOne(Profile::className(),['id'=>'manager_id' ]);
    }

    public function getAccount(){
        return $this->hasOne(Account::className(),['id'=>'account_id' ]);
    }

    public function getDeal(){
        return $this->hasOne(Deal::className(),['id'=>'deal_id' ]);
    }
}
