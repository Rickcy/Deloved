<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
 */
class Profile extends ActiveRecord
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'email' => 'Email',
            'cellPhone' => 'Cell Phone',
            'avatar_id' => 'Avatar ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'chargeStatus' => 'Charge Status',
            'chargeTill' => 'Charge Till',
            'user_id' => 'User ID',
        ];
    }
}
