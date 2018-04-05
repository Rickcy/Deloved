<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "managers".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $account_id
 *
 * @property Account $account
 * @property Profile $profile
 */
class Managers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'managers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'account_id'], 'required'],
            [['profile_id', 'account_id'], 'integer'],
            [['profile_id'], 'unique'],
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
            'account_id' => Yii::t('app', 'Account ID'),
        ];
    }


    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
