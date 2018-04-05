<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dispute_post".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $post
 * @property string $date_created
 * @property integer $dispute_id
 * @property integer $status
 *
 * @property Dispute $dispute
 * @property Profile $profile
 * @property DisputePostAttach[] $disputePostAttaches
 */
class DisputePost extends \yii\db\ActiveRecord
{

    public $last_post_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispute_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'dispute_id'], 'integer'],
            [['post'], 'string'],
            [['post'], 'required'],
            [['date_created','status','last_post_id'], 'safe'],
            [['dispute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dispute::className(), 'targetAttribute' => ['dispute_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'post' => Yii::t('app', 'Post'),
            'date_created' => Yii::t('app', 'Date Created'),
            'dispute_id' => Yii::t('app', 'Dispute ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispute()
    {
        return $this->hasOne(Dispute::className(), ['id' => 'dispute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisputePostAttaches()
    {
        return $this->hasMany(DisputePostAttach::className(), ['dispute_post_id' => 'id']);
    }
}
