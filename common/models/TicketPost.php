<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $post
 * @property string $date_created
 * @property integer $status
 * @property integer $ticket_id
 *
 * @property Profile $profile
 * @property Ticket $ticket
 * @property TicketPostAttach[] $ticketPostAttaches
 */
class TicketPost extends \yii\db\ActiveRecord
{

    public $last_post_id;


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
            [['profile_id', 'ticket_id'], 'integer'],
            [['date_created','status','last_post_id'], 'safe'],
            [['post'], 'string', 'max' => 255],
            [['post'], 'required'],
            ['status', 'in', 'range' => array_keys(Ticket::getAllAllowedStatuses())],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
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
            'post' => Yii::t('app', 'Post'),
            'date_created' => Yii::t('app', 'Date Created'),
            'status' => Yii::t('app', 'Status'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
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
