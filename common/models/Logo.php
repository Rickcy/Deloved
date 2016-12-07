<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "logo".
 *
 * @property integer $id
 * @property integer $created_at
 * @property string $image_name
 * @property string $file
 * @property integer $user_id
 *
 * @property Account[] $accounts
 * @property Account $user
 */
class Logo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['image_name', 'file'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'logo_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'image_name' => Yii::t('app', 'Image Name'),
            'file' => Yii::t('app', 'File'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['logo_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Account::className(), ['logo_id' => 'user_id']);
    }
}