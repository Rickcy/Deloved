<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $support_id
 * @property string $post
 * @property string $date_created
 * @property integer $status
 * @property integer $ticket_id
 *
 * @property Profile $support
 * @property Ticket $ticket
 * @property TicketPostAttach[] $ticketPostAttaches
 */
class TicketPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'support_id', 'status', 'ticket_id'], 'integer'],
            [['date_created'], 'safe'],
            [['post'], 'string', 'max' => 255],
            [['support_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['support_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
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
            'support_id' => Yii::t('app', 'Support ID'),
            'post' => Yii::t('app', 'Post'),
            'date_created' => Yii::t('app', 'Date Created'),
            'status' => Yii::t('app', 'Status'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
        ];
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
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketPostAttaches()
    {
        return $this->hasMany(TicketPostAttach::className(), ['ticket_post_id' => 'id']);
    }
}
