<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_deal_post".
 *
 * @property integer $id
 * @property integer $deal_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Deal $deal
 * @property Profile $forProfile
 */
class NewDealPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_deal_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deal_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
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
            'deal_id' => Yii::t('app', 'Deal ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
