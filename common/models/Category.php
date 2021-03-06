<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $categorytype_id
 *
 * @property AccountCategory[] $accountCategories
 * @property Category $parent
 * @property Category[] $categories
 * @property CategoryType $categorytype
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'categorytype_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['categorytype_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryType::className(), 'targetAttribute' => ['categorytype_id' => 'id']],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'categorytype_id' => Yii::t('app', 'Categorytype ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCategories()
    {
        return $this->hasMany(AccountCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getChild(){
        return $this->hasMany(Category::className(),['parent_id'=>'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorytype()
    {
        return $this->hasOne(CategoryType::className(), ['id' => 'categorytype_id']);
    }

    public function equelsVar($id,$array){
        if (is_array($array)){
        foreach ($array as $arr){
            if ($arr->category_id==$id){
                return '{"opened":false,"selected":true}';
            }
        }
        }elseif (!is_array($array)){
            if ($array->category_id==$id){
                return '{"opened":false,"selected":true}';
            }
        }
        return false;

    }
}
