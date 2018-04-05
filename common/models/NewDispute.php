<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_dispute".
 *
 * @property integer $id
 * @property integer $new_dispute_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Dispute $newDispute
 * @property Profile $forProfile
 */
class NewDispute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_dispute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_dispute_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['new_dispute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dispute::className(), 'targetAttribute' => ['new_dispute_id' => 'id']],
            [['for_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['for_profile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'new_dispute_id' => Yii::t('app', 'New Dispute ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewDispute()
    {
        return $this->hasOne(Dispute::className(), ['id' => 'new_dispute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
