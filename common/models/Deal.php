<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deal".
 *
 * @property integer $id
 * @property integer $failed_by_id
 * @property string $date_created
 * @property integer $buyer_id
 * @property integer $seller_id
 * @property integer $status
 *
 * @property Profile $failedBy
 * @property Profile $buyer
 * @property Profile $seller
 * @property DealPost[] $dealPosts
 * @property NewDeal[] $newDeals
 */
class Deal extends \yii\db\ActiveRecord
{

    public $isBuyer;

    public $detailText;

    public $item;


    /* Статусы сделки при заключении договора */
    const PROPOSED = 100;                     //Сделка предложена
    const DISCASS = 101;                      //Обсуждение условий сделки
    const SELLER_SIGN = 102;                  //Договор подписан продавцом
    const BUYER_SIGN = 103;                   //Договор подписан покупателем
    const SIGN_UP = 104;                      //Договор подписан

    /* Статусы сделки без предоплаты */
    const WAIT_NON_PAIDED_EXECUTE = 200;     //Ожидание исполнения обязательств по сделке
    const NON_PAIDED_EXECUTE = 201;          //Обязательства по сделке исполнены
    const FULL_POST_PAID = 202;              //Оплата внесена

    /* Статусы сделки с полной предоплатой */
    const FULL_PRE_PAID = 300;                //Полная предоплата внесена
    const FULL_PRE_PAID_CONFIRM = 302;        //Полная предоплата подтвержденна
    const WAIT_PAIDED_EXECUTE = 303;          //Ожидание исполнения обязательств по сделке
    const PAIDED_EXECUTE = 304;               //Обязательбства по сделке исполнены

    /* Статусы сделки с частичной предоплатой */
    const HALF_PRE_PAID = 400;                //Частичная предоплата внесена
    const HALF_PRE_PAID_CONFIRM = 401;        //Частичная предоплата подтвержденна
    const WAIT_HALF_PAIDED_EXECUTE = 402;     //Ожидание исполнения обязательств по сделке
    const HALF_PAIDED_EXECUTE = 403;          //Обязательства по сделке исполнены
    const HALF_POST_PAIDED = 404;             //Полная предоплата внесена

    /* Служебные статусы */
    const CONFIRMED = 500;                    //Успешная сделка
    const REJECTED = 501;                     //Сделка отвергнута
    const FAILED = 503;                       //Обязательство по сделке не исполнено
    const SUSPENDED = 504;                    //Сделка приостановлена



    const FOR_REVIEW = 600;
    const NOT_FOR_REVIEW = 601;


    public static function getAllStatuses(){
        $statuses =[
          self::PROPOSED =>"Сделка предложена" ,
          self::DISCASS =>"Обсуждение условий сделки"  ,
          self::SIGN_UP =>"Договор подписан"  ,
          self::WAIT_NON_PAIDED_EXECUTE =>"Ожидание исполнения обязательств по сделке"  ,
          self::NON_PAIDED_EXECUTE =>"Обязательства по сделке исполнены"  ,
          self::FULL_POST_PAID =>"Оплата внесена"  ,
          self::FULL_PRE_PAID =>"Полная предоплата внесена"  ,
          self::FULL_PRE_PAID_CONFIRM =>"Полная предоплата подтвержденна"  ,
          self::WAIT_PAIDED_EXECUTE =>"Ожидание исполнения обязательств по сделке"  ,
          self::PAIDED_EXECUTE =>"Обязательбства по сделке исполнены"  ,
          self::HALF_PRE_PAID =>"Частичная предоплата внесена"  ,
          self::HALF_PRE_PAID_CONFIRM =>"Частичная предоплата подтвержденна"  ,
          self::WAIT_HALF_PAIDED_EXECUTE =>"Частичная предоплата подтвержденна"  ,
          self::HALF_PAIDED_EXECUTE =>"Обязательства по сделке исполнены"  ,
          self::HALF_POST_PAIDED =>"Полная предоплата внесена"  ,
          self::CONFIRMED =>"Успешная сделка"  ,
          self::REJECTED =>"Сделка отвергнута"  ,
          self::FAILED =>"Обязательство по сделке не исполнено"  ,
          self::SUSPENDED =>"Сделка приостановлена"  ,
        ];
        return $statuses;
    }



    public function isOldDeal(){
        $deal = DealPost::findOne(['deal_id'=>$this->id,'status'=>self::CONFIRMED]);

        if(!$deal){
            $deal = DealPost::findOne(['deal_id'=>$this->id,'status'=>self::FAILED]);

        }
        if(!$deal){
            return self::REJECTED;
        }
       $now = (new \DateTime())->format('Y-m-d H:i:s');
       $deal_date = (new \DateTime($deal->date_created))->add(new \DateInterval('P1M'))->format('Y-m-d H:i:s');
       if ($deal_date > $now ){
           return self::FOR_REVIEW;
       }
       else{
           return self::NOT_FOR_REVIEW;
       }
    }

    public static function getPosition($status){
        switch ($status) {
            case 100: return 7;
			case 101: return 14;
			case 102: return 21;
			case 103: return 21;
			case 104: return 28;

			case 200: return 46;
			case 201: return 64;
			case 202: return 82;

			case 300: return 46;
			case 301: return 64;
			case 302: return 82;
			case 304: return 95;

			case 400: return 40;
			case 401: return 52;
			case 402: return 64;
			case 403: return 76;
			case 404: return 88;

			case 500:return 100;
			case 501:return 100;
			case 502:return 100;
			case 503:return 100;
			default: return 100;
		}
    }


    public function isOwner(){
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        $firstDealPost = DealPost::findOne(['deal_id'=>$this->id]);
        $ownerDeal = Profile::findOne($firstDealPost->profile_id);
        if ($profile->id === $ownerDeal->id){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal';
    }

    public static function getNameStatus($status)
    {
        $statuses =[
            self::PROPOSED =>'Сделка предложена',
            self::DISCASS =>'Обсуждение условий сделки',

            self::SELLER_SIGN =>'Договор подписан продавцом',
            self::BUYER_SIGN =>'Договор подписан покупателем',
            self::SIGN_UP =>'Договор подписан',

            self::WAIT_NON_PAIDED_EXECUTE =>'Ожидание исполнения обязательств по сделке',
            self::NON_PAIDED_EXECUTE =>'Обязательства по сделке исполнены',
            self::FULL_POST_PAID =>'Оплата внесена',

            self::FULL_PRE_PAID =>'Полная оплата внесена',
            self::FULL_PRE_PAID_CONFIRM =>'Полная оплата подтвержденна',
            self::WAIT_PAIDED_EXECUTE =>'Ожидание исполнения обязательств по сделке',
            self::PAIDED_EXECUTE =>'Обязательбства по сделке исполнены',

            self::HALF_PRE_PAID =>'Частичная оплата внесена',
            self::HALF_PRE_PAID_CONFIRM =>'Частичная оплата подтвержденна',

            self::WAIT_HALF_PAIDED_EXECUTE =>'Ожидание исполнения обязательств по сделке',

            self::HALF_PAIDED_EXECUTE =>'Обязательства по сделке исполнены',

            self::HALF_POST_PAIDED =>'Полная оплата внесена',

            self::CONFIRMED =>'Успешная сделка',
            self::REJECTED =>'Сделка отвергнута',
            self::FAILED =>'Обязательство по сделке не исполнено',
            self::SUSPENDED =>'Сделка приостановлена',
        ];
        return $statuses[$status];
    }


    public function isBuyer(){
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        if($this->buyer_id === $profile->id){
            return true;
        }
        else{
            return false;
        }
    }

    public function getNextAllowedStatuses($status)
    {
        switch ($status) {
            case self::PROPOSED:
                if (!$this->isOwner()) {  //если пользователь инициатор сделки
                    return [self::DISCASS, self::REJECTED];
				} else {				 //если пользователь акцептор сделки
                    return [self::REJECTED];
				}
		}

		if (!$this->isBuyer()) { // продавец
            switch ($status) {

                case self::DISCASS: return [self::SELLER_SIGN, self::REJECTED];
                case self::SELLER_SIGN: return [self::REJECTED];
                case self::BUYER_SIGN: return [self::SIGN_UP, self::REJECTED];
                case self::SIGN_UP: return [];

                case self::WAIT_NON_PAIDED_EXECUTE: return [self::NON_PAIDED_EXECUTE];
                case self::FULL_PRE_PAID: return [self::FULL_PRE_PAID_CONFIRM];
                case self::HALF_PRE_PAID: return [self::HALF_PRE_PAID_CONFIRM];

                case self::FULL_POST_PAID: return [self::CONFIRMED];
                case self::WAIT_PAIDED_EXECUTE: return [self::PAIDED_EXECUTE];

                case self::WAIT_HALF_PAIDED_EXECUTE: return [self::HALF_PAIDED_EXECUTE];
                case self::HALF_POST_PAIDED: return [self::CONFIRMED];
                case self::CONFIRMED: return [];
			}
        } else { // покупатель
            switch ($status) {
                case self::DISCASS: return [self::BUYER_SIGN,self::REJECTED];
                case self::BUYER_SIGN: return [self::REJECTED];
                case self::SELLER_SIGN: return [self::SIGN_UP,self::REJECTED];
                case self::SIGN_UP: return [self::WAIT_NON_PAIDED_EXECUTE,self::FULL_PRE_PAID,self::HALF_PRE_PAID];
                case self::NON_PAIDED_EXECUTE: return [self::FULL_POST_PAID];
                case self::FULL_PRE_PAID_CONFIRM: return [self::WAIT_PAIDED_EXECUTE];
                case self::HALF_PRE_PAID_CONFIRM: return [self::WAIT_HALF_PAIDED_EXECUTE];
                case self::HALF_PAIDED_EXECUTE: return [self::HALF_POST_PAIDED];
                case self::PAIDED_EXECUTE: return [self::CONFIRMED];
                case self::CONFIRMED: return [];
			}
        }
        return [];

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buyer_id', 'seller_id', 'status','isBuyer'], 'integer'],
            [['failed_by_id','date_created','detailText','item'], 'safe'],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['seller_id' => 'id']],
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
            'buyer_id' => Yii::t('app', 'Buyer ID'),
            'seller_id' => Yii::t('app', 'Seller ID'),
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
    public function getBuyer()
    {
        return $this->hasOne(Profile::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Profile::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealPosts()
    {
        return $this->hasMany(DealPost::className(), ['deal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewDeals()
    {
        return $this->hasMany(NewDeal::className(), ['new_deal_id' => 'id']);
    }
}
