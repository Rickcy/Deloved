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


    public $image_file;

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
            [['image_name', 'file'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['image_file'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
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

    public function uploadMainImage($account_id)
    {
        $path = Yii::getAlias('@app/web/uploads/accounts/' . $account_id);
        BaseFileHelper::createDirectory($path);
        if ($this->validate()) {

           $name=$this->image_name = Yii::$app->security->generateRandomString();
            $this->user_id = $account_id;
            $this->file = $path . DIRECTORY_SEPARATOR . $name.'.png';
            $this->created_at=time();
            $this->main_image=1;
            $this->save();
            $this->image_file->saveAs('uploads/accounts/' . $account_id . '/' . $name.'.png');

            return true;
        } else {
            return false;
        }
    }
}
