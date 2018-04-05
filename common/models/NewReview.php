<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_review".
 *
 * @property integer $id
 * @property integer $new_review_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Profile $forProfile
 * @property Review $newReview
 */
class NewReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_review_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['for_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['for_profile_id' => 'id']],
            [['new_review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::className(), 'targetAttribute' => ['new_review_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'new_review_id' => Yii::t('app', 'New Review ID'),
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
    public function getNewReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'new_review_id']);
    }
}
