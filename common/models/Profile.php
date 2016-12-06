<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $fio
 * @property string $email
 * @property string $cellPhone
 * @property integer $avatar_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $chargeStatus
 * @property integer $chargeTill
 * @property integer $user_id
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['avatar_id', 'created_at', 'updated_at', 'chargeStatus', 'chargeTill', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['fio', 'email', 'cellPhone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'Fio'),
            'email' => Yii::t('app', 'Email'),
            'cellPhone' => Yii::t('app', 'Cell Phone'),
            'avatar_id' => Yii::t('app', 'Avatar ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'chargeStatus' => Yii::t('app', 'Charge Status'),
            'chargeTill' => Yii::t('app', 'Charge Till'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
