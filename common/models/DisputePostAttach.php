<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dispute_post_attach".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $attachment_id
 * @property integer $dispute_id
 * @property integer $dispute_post_id
 *
 * @property Attachment $attachment
 * @property DisputePost $disputePost
 * @property Profile $profile
 */
class DisputePostAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispute_post_attach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'attachment_id', 'dispute_id', 'dispute_post_id'], 'integer'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['dispute_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisputePost::className(), 'targetAttribute' => ['dispute_post_id' => 'id']],
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
            'dispute_id' => Yii::t('app', 'Dispute ID'),
            'dispute_post_id' => Yii::t('app', 'Dispute Post ID'),
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
    public function getDisputePost()
    {
        return $this->hasOne(DisputePost::className(), ['id' => 'dispute_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
