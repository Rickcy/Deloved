<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "new_suggestion".
 *
 * @property integer $id
 * @property integer $new_suggestion_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Profile $forProfile
 * @property Suggestion $newSuggestion
 */
class NewSuggestion extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_suggestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_suggestion_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['for_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['for_profile_id' => 'id']],
            [['new_suggestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suggestion::className(), 'targetAttribute' => ['new_suggestion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'new_suggestion_id' => Yii::t('app', 'New Suggestion ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewSuggestion()
    {
        return $this->hasOne(Suggestion::className(), ['id' => 'new_suggestion_id']);
    }
}
