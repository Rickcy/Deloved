<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "new_account".
 *
 * @property integer $id
 * @property integer $new_account_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Account $newAccount
 * @property Profile $forProfile
 */
class NewAccount extends \yii\db\ActiveRecord
{




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_account_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['new_account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['new_account_id' => 'id']],
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
            'new_account_id' => Yii::t('app', 'New Account ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'new_account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
