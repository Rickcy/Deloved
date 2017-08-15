<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "new_service".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $new_service_id
 * @property integer $for_profile_id
 * @property string $date_created
 *
 * @property Account $account
 * @property Profile $forProfile
 * @property Services $newService
 */
class NewService extends \yii\db\ActiveRecord
{




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'new_service_id', 'for_profile_id'], 'integer'],
            [['date_created'], 'safe'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['for_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['for_profile_id' => 'id']],
            [['new_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['new_service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'new_service_id' => Yii::t('app', 'New Service ID'),
            'for_profile_id' => Yii::t('app', 'For Profile ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
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
    public function getForProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'for_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewService()
    {
        return $this->hasOne(Services::className(), ['id' => 'new_service_id']);
    }
}
