<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_created
 * @property integer $profile_id
 * @property integer $status
 * @property integer $support_id
 *
 * @property Profile $profile
 * @property Profile $support
 * @property TicketPost[] $ticketPosts

 */
class Ticket extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 10;
    const STATUS_CLOSED = 20;


    public $detailText;

    public static function getNameStatus($status){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_CLOSED => Yii::t('app','Closed'),
        ];
        return $statusList[$status];
    }

    public static function getAllAllowedStatuses(){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_CLOSED => Yii::t('app','Closed'),
        ];

        return $statusList;
    }

    public static function getNextAllowedStatuses($status){
        $statusList = [
            self::STATUS_NEW => [
                self::STATUS_PROCESSING => Yii::t('app','In Processing'),
                self::STATUS_CLOSED => Yii::t('app','Closed')
            ],
            self::STATUS_PROCESSING => [self::STATUS_CLOSED => Yii::t('app','Closed')]
        ];

        return $statusList[$status];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created'], 'safe'],
            [['profile_id', 'status', 'support_id'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['name'], 'required'],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['support_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Topic of the appeal'),
            'detailText' => Yii::t('app', 'Detail subscribe'),
            'date_created' => Yii::t('app', 'Date Created'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'status' => Yii::t('app', 'Status'),
            'support_id' => Yii::t('app', 'Support ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupport()
    {
        return $this->hasOne(Profile::className(), ['id' => 'support_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketPosts()
    {
        return $this->hasMany(TicketPost::className(), ['ticket_id' => 'id']);
    }
}
