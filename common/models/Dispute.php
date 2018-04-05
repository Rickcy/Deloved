<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dispute".
 *
 * @property integer $id
 * @property integer $failed_by_id
 * @property string $date_created
 * @property integer $profile_id
 * @property integer $partner_id
 * @property integer $deal_id
 * @property integer $mediator_id
 * @property integer $status
 *
 * @property DealPost[] $dealPosts
 * @property Profile $failedBy
 * @property Profile $profile
 * @property Profile $partner
 * @property DisputePost[] $disputePosts
 * @property NewDispute[] $newDisputes
 */
class Dispute extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 10;
    const STATUS_RESOLVE_WS = 20;
    const STATUS_FAILED = 30;

    public $detailText;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispute';
    }

    public static function getNameStatus($status){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),
            self::STATUS_FAILED => Yii::t('app','Failed'),
        ];
        return $statusList[$status];
    }

    public static function getAllAllowedStatuses(){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),
            self::STATUS_FAILED => Yii::t('app','Failed'),
        ];

        return $statusList;
    }

    public static function getNextAllowedStatuses($status){
        $statusList = [
            self::STATUS_NEW => [
                self::STATUS_PROCESSING => Yii::t('app','In Processing')
            ],
            self::STATUS_PROCESSING => [self::STATUS_FAILED => Yii::t('app','Failed'),self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),]
        ];

        return $statusList[$status];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['failed_by_id', 'profile_id', 'partner_id', 'deal_id', 'mediator_id', 'status'], 'integer'],
            [['detailText'], 'required'],
            [['date_created'], 'safe'],
            [['failed_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['failed_by_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['partner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'failed_by_id' => Yii::t('app', 'Failed By ID'),
            'date_created' => Yii::t('app', 'Date Created'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'partner_id' => Yii::t('app', 'Partner ID'),
            'detailText' => Yii::t('app', 'Detail subscribe'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'mediator_id' => Yii::t('app', 'Mediator ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealPosts()
    {
        return $this->hasMany(DealPost::className(), ['dispute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFailedBy()
    {
        return $this->hasOne(Profile::className(), ['id' => 'failed_by_id']);
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
    public function getPartner()
    {
        return $this->hasOne(Profile::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisputePosts()
    {
        return $this->hasMany(DisputePost::className(), ['dispute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewDisputes()
    {
        return $this->hasMany(NewDispute::className(), ['new_dispute_id' => 'id']);
    }
}
