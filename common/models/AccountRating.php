<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_rating".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $claim
 * @property integer $dispute
 * @property integer $review
 * @property integer $deal_id
 * @property integer $deal_fail
 * @property integer $deal_success
 *
 * @property Account $account
 * @property Deal $deal
 */
class AccountRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'claim', 'dispute', 'review', 'deal_id', 'deal_fail', 'deal_success'], 'integer'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
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
            'claim' => Yii::t('app', 'Claim'),
            'dispute' => Yii::t('app', 'Dispute'),
            'review' => Yii::t('app', 'Review'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'deal_fail' => Yii::t('app', 'Deal Fail'),
            'deal_success' => Yii::t('app', 'Deal Success'),
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
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }
}
