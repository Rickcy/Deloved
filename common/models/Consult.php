<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "consult".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_created
 * @property integer $profile_id
 * @property integer $status
 * @property integer $jurist_id
 *
 * @property Profile $profile
 * @property Profile $jurist
 * @property ConsultPost[] $consultPosts
 * @property NewConsult[] $newConsults
 * @property NewConsultPost[] $newConsultPosts
 */
class Consult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created'], 'safe'],
            [['profile_id', 'status', 'jurist_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['jurist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['jurist_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_created' => Yii::t('app', 'Date Created'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'status' => Yii::t('app', 'Status'),
            'jurist_id' => Yii::t('app', 'Jurist ID'),
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
    public function getJurist()
    {
        return $this->hasOne(Profile::className(), ['id' => 'jurist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['consult_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewConsults()
    {
        return $this->hasMany(NewConsult::className(), ['new_consult_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewConsultPosts()
    {
        return $this->hasMany(NewConsultPost::className(), ['consult_id' => 'id']);
    }
}
