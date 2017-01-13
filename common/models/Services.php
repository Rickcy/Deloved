<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $description
 * @property integer $rating_count
 * @property integer $rating_service
 * @property integer $payment_methods_id
 * @property integer $account_id
 * @property integer $category_type_id
 * @property integer $category_id
 * @property integer $date_created
 * @property integer $show_main
 * @property integer $photo_id
 * @property integer $measure_id
 * @property integer $currency_id
 *
 * @property PaymentMethods $paymentMethods
 * @property Account $account
 * @property Category $category
 * @property CategoryType $categoryType
 * @property Currency $currency
 * @property Measure $measure
 * @property Photo $photo
 */
class Services extends \yii\db\ActiveRecord
{

    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'account_id', 'category_type_id', 'category_id', 'measure_id', 'currency_id'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['rating_count', 'rating_service', 'payment_methods_id',  'account_id', 'category_type_id', 'category_id', 'date_created', 'show_main', 'photo_id', 'measure_id', 'currency_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['payment_methods_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethods::className(), 'targetAttribute' => ['payment_methods_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryType::className(), 'targetAttribute' => ['category_type_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Measure::className(), 'targetAttribute' => ['measure_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_id' => 'id']],
            ['image', 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg']
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
            'description' => Yii::t('app', 'Description'),
            'rating_count' => Yii::t('app', 'Rating Count'),
            'rating_service' => Yii::t('app', 'Rating Service'),
            'payment_methods_id' => Yii::t('app', 'Payment methods'),
            'account_id' => Yii::t('app', 'Account'),
            'category_type_id' => Yii::t('app', 'Category Type'),
            'category_id' => Yii::t('app', 'Category'),
            'date_created' => Yii::t('app', 'Date Created'),
            'show_main' => Yii::t('app', 'Show main'),
            'photo_id' => Yii::t('app', 'Photo'),
            'measure_id' => Yii::t('app', 'Measure'),
            'currency_id' => Yii::t('app', 'Currency'),
        ];
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
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }
}
