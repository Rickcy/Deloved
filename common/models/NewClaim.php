<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_claim".
 *
 * @property integer $id
 * @property integer $new_claim_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Claim $newClaim
 * @property Profile $forProfile
 */
class NewClaim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_claim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_claim_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['new_claim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Claim::className(), 'targetAttribute' => ['new_claim_id' => 'id']],
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
            'new_claim_id' => Yii::t('app', 'New Claim ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewClaim()
    {
        return $this->hasOne(Claim::className(), ['id' => 'new_claim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
