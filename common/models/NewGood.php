<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "new_good".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $new_good_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Account $account
 * @property Goods $newGood
 * @property Profile $forProfile
 */
class NewGood extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_good';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'new_good_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['new_good_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['new_good_id' => 'id']],
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
            'account_id' => Yii::t('app', 'Account ID'),
            'new_good_id' => Yii::t('app', 'New Good ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'new_good_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }
}
