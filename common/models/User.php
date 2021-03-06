<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\rbac\Role;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property boolean $online
 * @property string $auth_key
 * @property integer $status
 * @property string $password write-only password
 * @property integer $role_id
 * @property string $email_confirm_token
 *
 * @property Profile $profile
 * @property \common\models\Role $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DETECTED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_ID = 1;

   const ONLINE = true;
   const OFFLINE = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DETECTED]],
            ['role_id','default', 'value' => self::ROLE_ID],
            ['online','boolean'],
        ];
    }


    /**
    * Check Free User
     **/
    public function freeUser(){
        $user = User::findOne(Yii::$app->user->id);
        $profile = $user->profile;
        if($profile){
        if($profile->chargeStatus>0){
            return false;
        }else{
            return true;
        }}
    }


    /**
     * CheckRole
     * @param array $roles
     * @return bool|null
     */

    public static  function checkRole($roles=[]){

        
        $user = User::findOne(Yii::$app->user->id);
        $role = $user->role;
        $role_name = $role->role_name;

            if (in_array($role_name, $roles)) {
                return true;
            } else{
                return false;
            }

    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
        Return Role
     **/

    public function getRole(){
        return $this->hasOne(\common\models\Role::className(),['id'=>'role_id']);
    }

    /**
    Return Accounts
     **/



    /**
    Return Profile
     **/

    public function getProfile(){
        return $this->hasOne(Profile::className(),['user_id'=>'id' ]);
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @param string $email_confirm_token
     *
     * @return static
     */
    public static function findByEmailConfirmToken($email_confirm_token){
        return static::findOne(['email_confirm_token'=>$email_confirm_token,'role_id'=>self::ROLE_ID]);
    }


    public function generateEmailConfirmToken(){
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    public function removeEmailConfirmToken(){
        $this->email_confirm_token=null;
    }
}
