<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $role_name
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{

    const ROLE_NONE = 1;
    const ROLE_USER = 2;
    const ROLE_ADMIN = 3;
    const ROLE_MANAGER = 4;
    const ROLE_JURIST = 5;
    const ROLE_JUDGE = 6;
    const ROLE_MEDIATOR = 7;
    const ROLE_SUPPORT = 8;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_name' => Yii::t('app', 'Role Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
}
