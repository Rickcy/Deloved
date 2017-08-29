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
 */
class Attachment extends \yii\db\ActiveRecord
{
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
}
