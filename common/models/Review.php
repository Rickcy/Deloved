<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $about_id
 * @property integer $deal_id
 * @property string $content
 * @property string $remark
 * @property string $date_created
 * @property string $date_published
 * @property boolean $published
 * @property integer $value
 *
 * @property NewReview[] $newReviews
 * @property Account $author
 * @property Account $about
 * @property Deal $deal
 */
class Review extends \yii\db\ActiveRecord
{

    const GOOD = 1;
    const NEUTRAL = 0;
    const BAD = -1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    public static function getValue($value)
    {
        if($value == 1){
            return '<span class="glyphicon glyphicon-plus-sign"></span>';
        }
        elseif ($value == 0){
            return '<span class="glyphicon glyphicon-record"></span>';
        }
        elseif ($value == -1){
            return '<span class="glyphicon glyphicon-minus-sign"></span>';
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'about_id', 'deal_id', 'value'], 'integer'],
            [['content'], 'string'],
            [['content'], 'required'],
            [['date_created', 'date_published','remark'], 'safe'],
            [['published'], 'boolean'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['about_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['about_id' => 'id']],
            [['deal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deal::className(), 'targetAttribute' => ['deal_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'about_id' => Yii::t('app', 'About ID'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'content' => Yii::t('app', 'Content'),
            'remark' => Yii::t('app', 'Remark'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_published' => Yii::t('app', 'Date Published'),
            'published' => Yii::t('app', 'Published'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewReviews()
    {
        return $this->hasMany(NewReview::className(), ['new_review_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Account::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbout()
    {
        return $this->hasOne(Account::className(), ['id' => 'about_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }




}
