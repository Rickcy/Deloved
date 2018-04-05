<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.01.18
 * Time: 14:39
 */

namespace common\models;


use yii\db\ActiveRecord;
/**
 * This is the model class for table "mail_template".
 *
 * @property integer $id
 * @property string template
 * @property integer type_template
 */
class MailTemplate extends ActiveRecord
{

    const  MAIL_TEMPLATE_GENERAL = 1;
    const  MAIL_TEMPLATE_INDIVIDUAL = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_template';
    }

    public function rules()
    {
        return [
            [['id','type_template'],'integer'],
            ['template','string'],
            [['type_template','template'],'required']
        ];
    }


}