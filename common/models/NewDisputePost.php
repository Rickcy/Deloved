<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_dispute_post".
 *
 * @property integer $id
 * @property integer $dispute_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Dispute $dispute
 * @property Profile $forProfile
 */
class NewDisputePost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_dispute_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dispute_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['dispute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dispute::className(), 'targetAttribute' => ['dispute_id' => 'id']],
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
            'dispute_id' => Yii::t('app', 'Dispute ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispute()
    {
        return $this->hasOne(Dispute::className(), ['id' => 'dispute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
