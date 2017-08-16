<?php

namespace common\models;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "photo_service".
 *
 * @property integer $id
 * @property string $filePath
 * @property integer $account_id
 * @property integer $item_id
 *
 * @property Services $item
 */
class PhotoService extends \yii\db\ActiveRecord
{


    /**
     * @var $photoFile UploadedFile
     */
    public $photoFile;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'item_id'], 'integer'],
            [['filePath'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filePath' => Yii::t('app', 'File Path'),
            'account_id' => Yii::t('app', 'Account ID'),
            'item_id' => Yii::t('app', 'Item ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Services::className(), ['id' => 'item_id']);
    }

    /**
     * @return string
     */
    public function uploadImage(){
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        if(!is_dir(Yii::getAlias('@uploadDir'))){
            BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir'),0777);

        }

        if(!is_dir(Yii::getAlias('@uploadDir').'/photo_item')){
            BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir').'/photo_item/',0777);
        }
        if(!is_dir(Yii::getAlias('@uploadDir').'/photo_item/'.$account->id.'/')){
            BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir').'/photo_item/'.$account->id.'/',0777);
        }

        $url = Yii::$app->security->generateRandomString(10).'.'.$this->photoFile->extension;
        $this->photoFile->saveAs(Yii::getAlias('@uploadDir').'/photo_item/'.$account->id.'/'.$url);
        chmod(Yii::getAlias('@uploadDir').'/photo_item/'.$account->id.'/'.$url,0777);
        return '/uploads/photo_item/'.$account->id.'/'.$url;
    }

}
