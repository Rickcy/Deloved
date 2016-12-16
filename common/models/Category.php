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
            [['id', 'name', 'categorytype_id'], 'required'],
            [['id', 'parent_id', 'categorytype_id'], 'integer'],
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
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
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


 

    public function getMainCategory(){
        $data = Category::find()->where('parent_id=:parent_id',[':parent_id'=>null])->all();
        return $data;
    }
}
