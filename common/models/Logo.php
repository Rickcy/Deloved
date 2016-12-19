<?php

namespace common\models;

use Yii;
use yii\helpers\BaseFileHelper;

/**
 * This is the model class for table "logo".
 *
 * @property integer $id
 * @property integer $created_at
 * @property string $image_name
 * @property string $file
 * @property integer $main_image
 * @property integer $user_id
 *
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

            [[ 'main_image', 'user_id'], 'integer'],
            [['image_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['file'],'file','extensions' => ['jpg','png','gif']],
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
            'image_file' => Yii::t('app', 'Image File'),
            'main_image' => Yii::t('app', 'Main Image'),
            'user_id' => Yii::t('app', 'User ID'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Account::className(), ['id' => 'user_id']);
    }

   
}
