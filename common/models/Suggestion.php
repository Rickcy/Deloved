<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suggestion".
 *
 * @property integer $id
 * @property string $content
 * @property integer $date_published
 * @property integer $author_id
 * @property integer $sug_category_id
 *
 * @property SuggestionCat $sugCategory
 * @property Profile $author
 */
class Suggestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suggestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'date_published', 'author_id', 'sug_category_id'], 'required'],
            [['content'], 'string'],
            [['date_published', 'author_id', 'sug_category_id'], 'integer'],
            [['sug_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuggestionCat::className(), 'targetAttribute' => ['sug_category_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'date_published' => Yii::t('app', 'Date Published'),
            'author_id' => Yii::t('app', 'Author ID'),
            'sug_category_id' => Yii::t('app', 'Sug Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSugCategory()
    {
        return $this->hasOne(SuggestionCat::className(), ['id' => 'sug_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Profile::className(), ['id' => 'author_id']);
    }
}
