<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_post_attach".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $attachment_id
 * @property integer $ticket_id
 * @property integer $ticket_post_id
 *
 * @property Attachment $attachment
 * @property Profile $profile
 * @property TicketPost $ticketPost
 */
class TicketPostAttach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_post_attach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'attachment_id', 'ticket_id', 'ticket_post_id'], 'integer'],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['ticket_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketPost::className(), 'targetAttribute' => ['ticket_post_id' => 'id']],
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
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'ticket_post_id' => Yii::t('app', 'Ticket Post ID'),
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
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketPost()
    {
        return $this->hasOne(TicketPost::className(), ['id' => 'ticket_post_id']);
    }
}
