<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deal_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $post
 * @property string $date_created
 * @property integer $deal_id
 * @property integer $claim_id
 * @property integer $dispute_id
 * @property integer $status
 *
 * @property Claim $claim
 * @property Deal $deal
 * @property Dispute $dispute
 * @property Profile $profile
 * @property DealPostAttach[] $dealPostAttaches
 */
class DealPost extends \yii\db\ActiveRecord
{


    public $last_post_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'deal_id'], 'integer'],
            [['post'], 'string','max' => 1000],
            [['post'], 'required'],
            [['date_created', 'claim_id','status', 'dispute_id','last_post_id'], 'safe'],
            [['claim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Claim::className(), 'targetAttribute' => ['claim_id' => 'id']],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
            [['dispute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dispute::className(), 'targetAttribute' => ['dispute_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'post' => Yii::t('app', 'Post'),
            'date_created' => Yii::t('app', 'Date Created'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'claim_id' => Yii::t('app', 'Claim ID'),
            'dispute_id' => Yii::t('app', 'Dispute ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaim()
    {
        return $this->hasOne(Claim::className(), ['id' => 'claim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispute()
    {
        return $this->hasOne(Dispute::className(), ['id' => 'dispute_id']);
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
    public function getDealPostAttaches()
    {
        return $this->hasMany(DealPostAttach::className(), ['deal_post_id' => 'id']);
    }
}
