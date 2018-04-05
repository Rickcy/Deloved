<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_deal".
 *
 * @property integer $id
 * @property integer $new_deal_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Deal $newDeal
 * @property Profile $forProfile
 */
class NewDeal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_deal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_deal_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['new_deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['new_deal_id' => 'id']],
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
            'new_deal_id' => Yii::t('app', 'New Deal ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'new_deal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
