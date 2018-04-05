<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "claim_post_attach".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $attachment_id
 * @property integer $claim_id
 * @property integer $claim_post_id
 *
 * @property Attachment $attachment
 * @property ClaimPost $claimPost
 * @property Profile $profile
 */
class ClaimPostAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'claim_post_attach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'attachment_id', 'claim_id', 'claim_post_id'], 'integer'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['claim_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClaimPost::className(), 'targetAttribute' => ['claim_post_id' => 'id']],
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
            'attachment_id' => Yii::t('app', 'Attachment ID'),
            'claim_id' => Yii::t('app', 'Claim ID'),
            'claim_post_id' => Yii::t('app', 'Claim Post ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachment()
    {
        return $this->hasOne(Attachment::className(), ['id' => 'attachment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimPost()
    {
        return $this->hasOne(ClaimPost::className(), ['id' => 'claim_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
