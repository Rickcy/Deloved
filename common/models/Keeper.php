<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 15.09.17
 * Time: 15:06
 */

namespace common\models;


use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "payment_request".
 *
 * @property integer $id
 * @property double  $balance
 * @property integer $currency_id
 * @property string  $number
 * @property integer $account_id
 *
 */
class Keeper extends ActiveRecord
{
    public static function tableName()
    {
        return 'keeper';
    }


    public static function hasKeeper($account)
    {
        /**
         * @var $account \common\models\Account
         */

        $keeper = $account->keeper;

        if(!$keeper){
           $keeper = new Keeper();
           $keeper->number = 'RUB000'.$account->id;
           $keeper->account_id = $account->id;
           $keeper->save();
         }

       return $keeper;

    }

    public function rules()
    {
        return [
            [['currency_id','account_id'],'integer'],
            ['balance','double'],
            [['number'],'string','max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'balance' => Yii::t('app', 'Balance'),
            'currency_id' => Yii::t('app', 'Currency'),
            'number' => Yii::t('app', 'Number'),
            'account_id' => Yii::t('app', 'Account'),
        ];
    }


}