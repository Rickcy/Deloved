<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deal_post_attach".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $attachment_id
 * @property integer $deal_id
 * @property integer $deal_post_id
 *
 * @property Attachment $attachment
 * @property DealPost $dealPost
 * @property Profile $profile
 */
class DealPostAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal_post_attach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'attachment_id', 'deal_id', 'deal_post_id'], 'integer'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['deal_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => DealPost::className(), 'targetAttribute' => ['deal_post_id' => 'id']],
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
            'deal_id' => Yii::t('app', 'Deal ID'),
            'deal_post_id' => Yii::t('app', 'Deal Post ID'),
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
    public function getDealPost()
    {
        return $this->hasOne(DealPost::className(), ['id' => 'deal_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
