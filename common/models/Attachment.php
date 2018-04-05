<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attachment".
 *
 * @property integer $id
 * @property string $filePath
 *
 * @property TicketPostAttach[] $ticketPostAttaches
 * @property DealPostAttach[] $dealPostAttach
 * @property ConsultPostAttach[] $consultPostAttach
 * @property DisputePostAttach[] $disputePostAttach
 * @property ClaimPostAttach[] $claimPostAttachv
 */
class Attachment extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filePath'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketPostAttaches()
    {
        return $this->hasMany(TicketPostAttach::className(), ['attachment_id' => 'id']);
    }

    public function getDealPostAttaches()
    {
        return $this->hasMany(DealPostAttach::className(), ['attachment_id' => 'id']);
    }

    public function getConsultPostAttaches()
    {
        return $this->hasMany(ConsultPostAttach::className(), ['attachment_id' => 'id']);
    }

    public function getDisputePostAttaches()
    {
        return $this->hasMany(DisputePostAttach::className(), ['attachment_id' => 'id']);
    }

    public function getClaimPostAttaches()
    {
        return $this->hasMany(ClaimPostAttach::className(), ['attachment_id' => 'id']);
    }
}
