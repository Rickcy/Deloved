<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "count_view".
 *
 * @property integer $id
 * @property integer $count_for_month
 * @property integer $count_goods_for_month
 * @property integer $count_services_for_month
 * @property integer $count_for_all
 * @property integer $count_goods_for_all
 * @property integer $count_services_for_all
 * @property integer $account_id
 */
class CountView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'count_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count_for_month', 'count_goods_for_month', 'count_services_for_month', 'count_for_all', 'count_goods_for_all', 'count_services_for_all', 'account_id'], 'integer'],
            [['account_id'], 'required'],
            [['account_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'count_for_month' => Yii::t('app', 'Count For Month'),
            'count_goods_for_month' => Yii::t('app', 'Count Goods For Month'),
            'count_services_for_month' => Yii::t('app', 'Count Services For Month'),
            'count_for_all' => Yii::t('app', 'Count For All'),
            'count_goods_for_all' => Yii::t('app', 'Count Goods For All'),
            'count_services_for_all' => Yii::t('app', 'Count Services For All'),
            'account_id' => Yii::t('app', 'Account ID'),
        ];
    }
}
