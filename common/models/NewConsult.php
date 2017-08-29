<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_consult".
 *
 * @property integer $id
 * @property integer $new_consult_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Consult $newConsult
 * @property Profile $forProfile
 */
class NewConsult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_consult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_consult_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['new_consult_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consult::className(), 'targetAttribute' => ['new_consult_id' => 'id']],
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
            'new_consult_id' => Yii::t('app', 'New Consult ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewConsult()
    {
        return $this->hasOne(Consult::className(), ['id' => 'new_consult_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
