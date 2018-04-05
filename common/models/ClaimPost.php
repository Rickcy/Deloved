<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "claim_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $post
 * @property string $date_created
 * @property integer $claim_id
 * @property integer $status
 *
 * @property Claim $claim
 * @property Profile $profile
 * @property ClaimPostAttach[] $claimPostAttaches
 */
class ClaimPost extends \yii\db\ActiveRecord
{

    public $last_post_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'claim_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'claim_id'], 'integer'],
            [['post'], 'string'],
            [['post'], 'required'],
            [['date_created','status','last_post_id'], 'safe'],
            [['claim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Claim::className(), 'targetAttribute' => ['claim_id' => 'id']],
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
            'claim_id' => Yii::t('app', 'Claim ID'),
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
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimPostAttaches()
    {
        return $this->hasMany(ClaimPostAttach::className(), ['claim_post_id' => 'id']);
    }
}
