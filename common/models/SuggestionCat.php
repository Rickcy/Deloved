<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suggestion_cat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 *
 * @property Suggestion[] $suggestions
 */
class SuggestionCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suggestion_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type communication'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestions()
    {
        return $this->hasMany(Suggestion::className(), ['sug_category_id' => 'id']);
    }
}
