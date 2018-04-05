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
 * @property string $date_created
 * @property integer $show_main
 * @property integer $measure_id
 * @property integer $currency_id
 *
 * @property PaymentMethods $paymentMethods
 * @property Account $account
 * @property Category $category
 * @property CategoryType $categoryType
 * @property Currency $currency
 * @property Measure $measure
 * @property PhotoService[] $photo
 */
class Services extends \yii\db\ActiveRecord
{

    public $photos;

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
            [['date_created','photos'], 'safe'],
            [['description'], 'string'],
            [['rating_count', 'rating_service', 'payment_methods_id',  'account_id', 'category_type_id', 'category_id', 'show_main',  'measure_id', 'currency_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['payment_methods_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethods::className(), 'targetAttribute' => ['payment_methods_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryType::className(), 'targetAttribute' => ['category_type_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Measure::className(), 'targetAttribute' => ['measure_id' => 'id']],
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
            'measure_id' => Yii::t('app', 'Measure'),
            'currency_id' => Yii::t('app', 'Currency'),
        ];
    }

    public static function getCategories($activeCat){
        $categories = [];
        $cats = Category::findAll(['parent_id'=>$activeCat->id]);
        if(count($cats) >0 ){
            foreach ($cats as $cat){
                $categories[]=$cat->id;
                $items = Category::findAll(['parent_id'=>$cat->id]);
                if(count($items) >0 ){
                    foreach ($items as $item){
                        $categories[]=$item->id;
                        $categs = Category::findAll(['parent_id'=>$item->id]);
                        if(count($categs) > 0 ){
                            foreach ($categs as $categ){
                                $categories[]=$categ->id;
                                $c = Category::findAll(['parent_id'=>$categ->id]);
                                if(count($c) > 0 ){
                                    foreach ($c as $cs){
                                        $categories[]=$cs->id;
                                        $s = Category::findAll(['parent_id'=>$cs->id]);
                                        if(count($s) > 0 ){
                                            foreach ($s as $w){
                                                $categories[]=$w->id;
                                                $c = Category::findAll(['parent_id'=>$w->id]);
                                                if(count($c) > 0 ){
                                                    foreach ($c as $cs){
                                                        $categories[]=$cs->id;

                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            }
        }
        else{
            $categories[]=$activeCat->id;
        }
        return $categories;
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
        return $this->hasMany(PhotoService::className(), ['item_id' => 'id']);
    }

    public function saveServicePhoto(){
        if($this->photos[0]){
        $imagesPaths = explode(',',$this->photos[0]);
        foreach ($imagesPaths as $path){
            $photo = new PhotoService();
            $photo->account_id = $this->account_id;
            $photo->item_id = $this->id;
            $photo->filePath = $path;
            $photo->save();
        }
        }

    }
}
