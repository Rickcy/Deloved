<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 15.09.17
 * Time: 14:54
 */

namespace common\models;


use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "payment_request".
 *
 * @property integer $id
 * @property string  $date_created
 * @property string  $last_updated
 * @property integer $keeper_id
 * @property integer $method_id
 * @property integer $account_id
 * @property integer $status
 * @property integer $value
 *
 * @property Keeper $keeper
 * @property Account $account
 * @property PaymentMethod $payMethod
 */
class PaymentRequest extends ActiveRecord
{
    public static function tableName()
    {
        return 'payment_request';
    }

    const STATUS_INITIATED = 0;
    const STATUS_PROCESSING = 5;
    const STATUS_COMPLETE = 10;
    const STATUS_CANCELLED = 20;


    public static function getStatus($status){
        $statuses = [
          self::STATUS_INITIATED =>Yii::t('app','INITIATED'),
          self::STATUS_PROCESSING =>Yii::t('app','PROCESSING'),
          self::STATUS_COMPLETE =>Yii::t('app','COMPLETE'),
          self::STATUS_CANCELLED =>Yii::t('app','CANCELLED'),
        ];

        return $statuses[$status];
    }

    public static function getStatusByString($string){
        $statuses = [
            'INITIATED'=>self::STATUS_INITIATED,
            'PROCESSING' => self::STATUS_PROCESSING ,
            'COMPLETE' =>self::STATUS_COMPLETE ,
            'CANCELLED' => self::STATUS_CANCELLED ,
        ];

        return $statuses[$string];
    }

    public function rules()
    {
        return [
            [['keeper_id','status','value','account_id','method_id'],'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_created' => Yii::t('app', 'Date Created'),
            'keeper_id' => Yii::t('app', 'Keeper'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'method_id' => Yii::t('app', 'Method'),
            'account_id' => Yii::t('app', 'Account'),
            'status' => Yii::t('app', 'Status'),
            'value' => Yii::t('app', 'Value'),
        ];
    }


    public static function getSecretSign($params) {
            $s = $params['MI_MERCHANT_ID'] . ';' .
                $params['LMI_PAYMENT_NO'] . ';' .
                $params['LMI_SYS_PAYMENT_ID'] . ';' .
                $params['LMI_SYS_PAYMENT_DATE'] . ';' .
                $params['LMI_PAYMENT_AMOUNT'] . ';' .
                $params['LMI_CURRENCY'] . ';' .
                $params['LMI_PAID_AMOUNT'] . ';' .
                $params['LMI_PAID_CURRENCY'] . ';' .
                $params['LMI_PAYMENT_SYSTEM'] . ';' .
            ($params['LMI_SIM_MODE'] ?: '') . ';' . 'dunkleosteus';
        return base64_encode(md5($s));
    }

    public static function checkSecretSign($params) {
        return $params['LMI_HASH'] == self::getSecretSign($params);
    }


    public static function checkParams($params) {
        $paymentRequest = PaymentRequest::findOne($params['LMI_PAYMENT_NO']);
        if (!$paymentRequest) {
            return false;
        }
        if ($params['LMI_PAYMENT_AMOUNT'] != $paymentRequest->value) {
                    return false;
         }
        if ($params['LMI_CURRENCY'] != 'RUB') {
                    return false;
        }
        if ($params['LMI_MERCHANT_ID'] != 'a2498ef4-9f7c-4bc0-ad34-edacc30ffc6b') {
                    return false;
        }

        return true;
    }


    public function getKeeper()
    {
        return $this->hasOne(Keeper::className(), ['keeper_id' => 'id']);
    }

    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['method_id' => 'id']);
    }

    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}