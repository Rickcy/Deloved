<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "check_accounts".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $acc_id
 * @property string $date_check
 * @property string $name
 * @property string $inn
 * @property string $ogrn
 * @property boolean $is_exist
 *
 * @property Profile $profile
 * @property Account $account
 *
 */
class CheckAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'check_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'inn', 'ogrn'], 'required'],
            [['profile_id'], 'integer'],
            [['date_check'], 'safe'],
            [['is_exist'], 'boolean'],
            [['name', 'inn', 'ogrn'], 'string', 'max' => 255],
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
            'date_check' => Yii::t('app', 'Date Check'),
            'name' => Yii::t('app', 'Name'),
            'inn' => Yii::t('app', 'Inn'),
            'ogrn' => Yii::t('app', 'Ogrn'),
            'is_exist' => Yii::t('app', 'Is Exist'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'acc_id']);
    }
}
