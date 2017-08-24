<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_ticket".
 *
 * @property integer $id
 * @property integer $new_ticket_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Profile $forProfile
 * @property Ticket $newTicket
 */
class NewTicket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_ticket_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['for_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['for_profile_id' => 'id']],
            [['new_ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['new_ticket_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'new_ticket_id' => Yii::t('app', 'New Ticket ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'new_ticket_id']);
    }
}
