<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $model
 * @property string $description
 * @property integer $availability
 * @property integer $rating_count
 * @property integer $rating_good
 * @property integer $condition_id
 * @property integer $payment_methods_id
 * @property integer $delivery_methods_id
 * @property integer $account_id
 * @property integer $category_type_id
 * @property integer $category_id
 * @property integer $date_created
 * @property integer $show_main
 * @property integer $photo_id
 * @property integer $measure_id
 * @property integer $currency_id
 *
 * @property Condition $condition
 * @property Account $account
 * @property Category $category
 * @property CategoryType $categoryType
 * @property Currency $currency
 * @property DeliveryMethods $deliveryMethods
 * @property Measure $measure
 * @property PaymentMethods $paymentMethods
 * @property Photo $photo
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'availability', 'account_id', 'category_type_id', 'category_id', 'measure_id', 'currency_id','price'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['availability', 'rating_count', 'rating_good', 'condition_id', 'payment_methods_id', 'delivery_methods_id', 'account_id', 'category_type_id', 'category_id', 'date_created', 'show_main', 'photo_id', 'measure_id', 'currency_id'], 'integer'],
            [['name', 'model'], 'string', 'max' => 255],
            [['condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Condition::className(), 'targetAttribute' => ['condition_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryType::className(), 'targetAttribute' => ['category_type_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['delivery_methods_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryMethods::className(), 'targetAttribute' => ['delivery_methods_id' => 'id']],
            [['measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Measure::className(), 'targetAttribute' => ['measure_id' => 'id']],
            [['payment_methods_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethods::className(), 'targetAttribute' => ['payment_methods_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'model' => Yii::t('app', 'Model'),
            'description' => Yii::t('app', 'Description'),
            'availability' => Yii::t('app', 'Availability'),
            'rating_count' => Yii::t('app', 'Rating Count'),
            'rating_good' => Yii::t('app', 'Rating Good'),
            'condition_id' => Yii::t('app', 'Condition ID'),
            'payment_methods_id' => Yii::t('app', 'Payment Methods ID'),
            'delivery_methods_id' => Yii::t('app', 'Delivery Methods ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'category_type_id' => Yii::t('app', 'Category Type ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'date_created' => Yii::t('app', 'Date Created'),
            'show_main' => Yii::t('app', 'Show Main'),
            'photo_id' => Yii::t('app', 'Photo ID'),
            'measure_id' => Yii::t('app', 'Measure ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondition()
    {
        return $this->hasOne(Condition::className(), ['id' => 'condition_id']);
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryType()
    {
        return $this->hasOne(CategoryType::className(), ['id' => 'category_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryMethods()
    {
        return $this->hasOne(DeliveryMethods::className(), ['id' => 'delivery_methods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasOne(PaymentMethods::className(), ['id' => 'payment_methods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }
}
