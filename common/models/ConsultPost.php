<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "consult_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $post
 * @property string $date_created
 * @property integer $status
 * @property integer $consult_id
 *
 * @property Consult $consult
 * @property Profile $profile
 * @property ConsultPostAttach[] $consultPostAttaches
 */
class ConsultPost extends \yii\db\ActiveRecord
{

    public $last_post_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id',  'consult_id'], 'integer'],
            [['post'], 'string'],
            [['post'], 'required'],
            ['status', 'in', 'range' => array_keys(Consult::getAllAllowedStatuses())],
            [['date_created','status','last_post_id'], 'safe'],
            [['consult_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consult::className(), 'targetAttribute' => ['consult_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
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
            'consult_id' => Yii::t('app', 'Consult ID'),
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
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPostAttaches()
    {
        return $this->hasMany(ConsultPostAttach::className(), ['consult_post_id' => 'id']);
    }
}
