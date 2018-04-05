<?php

namespace common\models;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "claim".
 *
 * @property integer $id
 * @property integer $failed_by_id
 * @property string $date_created
 * @property integer $profile_id
 * @property integer $partner_id
 * @property integer $deal_id
 * @property integer $judge_id
 * @property integer $status
 *
 * @property Profile $failedBy
 * @property Profile $profile
 * @property Profile $partner
 * @property Deal $deal
 * @property ClaimPost[] $claimPosts
 * @property DealPost[] $dealPosts
 * @property NewClaim[] $newClaims
 */
class Claim extends \yii\db\ActiveRecord
{

    public $detailText;

    /**
     * @var UploadedFile
     */
    public $claimSudFile;
    public $claimFile;
    public $claimOgovorFile;

    const STATUS_NEW = 0;
    const STATUS_RETURN = 5;
    const STATUS_PROCESSING = 10;
    const STATUS_RESOLVE = 20;
    const STATUS_RESOLVE_WS = 30;
    const STATUS_FAILED = 30;



    public static function getNameStatus($status){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_RETURN => Yii::t('app','Возвращен'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_RESOLVE => Yii::t('app','Удовлетворен'),
            self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),
            self::STATUS_FAILED => Yii::t('app','Не удовлетворен'),
        ];
        return $statusList[$status];
    }

    public static function getAllAllowedStatuses(){
        $statusList = [
            self::STATUS_NEW => Yii::t('app','New'),
            self::STATUS_RETURN => Yii::t('app','Возвращен'),
            self::STATUS_PROCESSING => Yii::t('app','In Processing'),
            self::STATUS_RESOLVE => Yii::t('app','Удовлетворен'),
            self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),
            self::STATUS_FAILED => Yii::t('app','Не удовлетворен'),
        ];

        return $statusList;
    }

    public static function getNextAllowedStatuses($status){
        $statusList = [
            self::STATUS_NEW => [
                self::STATUS_PROCESSING => Yii::t('app','In Processing'),
                self::STATUS_RETURN => Yii::t('app','Возвращен'),
            ],
            self::STATUS_PROCESSING => [self::STATUS_FAILED => Yii::t('app','Failed'),
                self::STATUS_RESOLVE_WS => Yii::t('app','Мировое соглашение'),
                self::STATUS_RESOLVE => Yii::t('app','Удовлетворен'),
                self::STATUS_FAILED => Yii::t('app','Не удовлетворен'),
                ]
        ];
        if (!isset($statusList[$status])){
            return [];
        }
        return $statusList[$status];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'claim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['failed_by_id', 'profile_id', 'partner_id', 'deal_id', 'judge_id', 'status'], 'integer'],
            [['detailText'], 'required'],
            [['claimSudFile','claimFile','claimOgovorFile'],'file'],
            [['date_created'], 'safe'],
            [['failed_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['failed_by_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['partner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'failed_by_id' => Yii::t('app', 'Failed By ID'),
            'date_created' => Yii::t('app', 'Date Created'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'detailText' => Yii::t('app', 'Detail subscribe'),
            'partner_id' => Yii::t('app', 'Partner ID'),
            'deal_id' => Yii::t('app', 'Deal ID'),
            'judge_id' => Yii::t('app', 'Judge ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFailedBy()
    {
        return $this->hasOne(Profile::className(), ['id' => 'failed_by_id']);
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
    public function getDeal()
    {
        return $this->hasOne(Deal::className(), ['id' => 'deal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Profile::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaimPosts()
    {
        return $this->hasMany(ClaimPost::className(), ['claim_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealPosts()
    {
        return $this->hasMany(DealPost::className(), ['claim_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewClaims()
    {
        return $this->hasMany(NewClaim::className(), ['new_claim_id' => 'id']);
    }

    public function uploadAndSaveFile()
    {
        $id = $this->id;
        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (!is_dir(Yii::getAlias('@uploadDir'))) {
            BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir'), 0777);

        }
        if (!is_dir(Yii::getAlias('@uploadDir') . '/claimFile/')) {
            BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/claimFile/', 0777);
        }

        $model = new Attachment();
        $url = Yii::$app->security->generateRandomString(10) . '.' . $this->claimFile->extension;
        $this->claimFile->saveAs(Yii::getAlias('@uploadDir') . '/claimFile/'  . $url);
        chmod(Yii::getAlias('@uploadDir') . '/claimFile/' . $url, 0777);
        $model->filePath = '/uploads/claimFile/'. $url;

        $claimPost = new ClaimPost();
        $claimPost->post = $this->claimFile->baseName;
        $claimPost->profile_id = $profile->id;
        $claimPost->claim_id = $id;
        $claimPost->date_created = date('Y-m-d H:i:s');
        $claimPost->save();

        $model->save();
        $claimPostAtt = new ClaimPostAttach();
        $claimPostAtt->profile_id = $profile->id;
        $claimPostAtt->claim_id = (int)$id;
        $claimPostAtt->attachment_id = $model->id;
        $claimPostAtt->claim_post_id = $claimPost->id;
        $claimPostAtt->save();


        $model = new Attachment();
        $url = Yii::$app->security->generateRandomString(10) . '.' . $this->claimSudFile->extension;
        $this->claimSudFile->saveAs(Yii::getAlias('@uploadDir') . '/claimFile/' . $url);
        chmod(Yii::getAlias('@uploadDir') . '/claimFile/'. $url, 0777);
        $model->filePath = '/uploads/claimFile/' . $url;

        $claimPost = new ClaimPost();
        $claimPost->post = $this->claimSudFile->baseName;
        $claimPost->profile_id = $profile->id;
        $claimPost->claim_id = $id;
        $claimPost->date_created = date('Y-m-d H:i:s');
        $claimPost->save();

        $model->save();
        $claimPostAtt = new ClaimPostAttach();
        $claimPostAtt->profile_id = $profile->id;
        $claimPostAtt->claim_id = (int)$id;
        $claimPostAtt->attachment_id = $model->id;
        $claimPostAtt->claim_post_id = $claimPost->id;
        $claimPostAtt->save();

        $model = new Attachment();
        $url = Yii::$app->security->generateRandomString(10) . '.' . $this->claimOgovorFile->extension;
        $this->claimOgovorFile->saveAs(Yii::getAlias('@uploadDir') . '/claimFile/'. $url);
        chmod(Yii::getAlias('@uploadDir') . '/claimFile/' . $url, 0777);
        $model->filePath = '/uploads/claimFile/'  . $url;

        $claimPost = new ClaimPost();
        $claimPost->post = $this->claimOgovorFile->baseName;
        $claimPost->profile_id = $profile->id;
        $claimPost->claim_id = $id;
        $claimPost->date_created = date('Y-m-d H:i:s');
        $claimPost->save();

        $model->save();
        $claimPostAtt = new ClaimPostAttach();
        $claimPostAtt->profile_id = $profile->id;
        $claimPostAtt->claim_id = (int)$id;
        $claimPostAtt->attachment_id = $model->id;
        $claimPostAtt->claim_post_id = $claimPost->id;
        $claimPostAtt->save();


    }
}
