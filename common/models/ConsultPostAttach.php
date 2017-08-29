<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "consult_post_attach".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $attachment_id
 * @property integer $consult_id
 * @property integer $consult_post_id
 *
 * @property Attachment $attachment
 * @property ConsultPost $consultPost
 * @property Profile $profile
 */
class ConsultPostAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_post_attach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'attachment_id', 'consult_id', 'consult_post_id'], 'integer'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['consult_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPost::className(), 'targetAttribute' => ['consult_post_id' => 'id']],
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
            'consult_id' => Yii::t('app', 'Consult ID'),
            'consult_post_id' => Yii::t('app', 'Consult Post ID'),
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
    public function getConsultPost()
    {
        return $this->hasOne(ConsultPost::className(), ['id' => 'consult_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
