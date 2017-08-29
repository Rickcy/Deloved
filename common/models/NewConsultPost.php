<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_consult_post".
 *
 * @property integer $id
 * @property integer $consult_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Consult $consult
 * @property Profile $forProfile
 */
class NewConsultPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_consult_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['consult_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consult::className(), 'targetAttribute' => ['consult_id' => 'id']],
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
            'consult_id' => Yii::t('app', 'Consult ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsult()
    {
        return $this->hasOne(Consult::className(), ['id' => 'consult_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
