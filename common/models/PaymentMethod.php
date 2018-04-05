<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 15.09.17
 * Time: 15:13
 */

namespace common\models;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "payment_method".
 *
 * @property integer $id
 * @property string  $code
 * @property string  $name
 * @property PaymentSystem $paySystem
 */



class PaymentMethod extends ActiveRecord
{
    public static function tableName()
    {
        return 'payment_method';
    }

    public function getPaymentSystem()
    {
        return $this->hasOne(PaymentSystem::className(), ['system_id' => 'id']);
    }

}