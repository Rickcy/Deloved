<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 23.12.2016
 * Time: 9:37
 */

namespace frontend\models;


use common\models\Account;
use common\models\AccountCategory;
use yii\base\Model;

class AccountForm extends Model
{
        public $full_name;
        public $org_form_id;
        public $brand_name;
        public $inn;
        public $ogrn;
        public $legal_address;
        public $date_reg;
        public $fax;
        public $web_address;
        public $email;
        public $description;
        public $director;
        public $work_time;
        public $city_id;
        public $address;
        public $keywords;
        public $public_status;
        public $verify_status;
        public $rating;
        public $profile_id;
        public $created_at;
        public $updated_at;
        public $show_main;
        public $phone1;
        public $date;
        public $profile_name;
        public $city_name;
        public $account_category_goods;
        public $account_category_service;




    public function rules()
    {
        return [
            [['email','full_name','city_name','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address',  'description', 'director', 'work_time', 'address', 'keywords'], 'trim'],
            [['inn', 'ogrn','org_form_id','email','full_name','city_name','address','date','legal_address','director','phone1'], 'required'],
            ['email', 'email'],


            [['org_form_id', 'public_status','show_main' ,'verify_status'], 'integer'],
            [['full_name','city_name','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email',  'director', 'work_time', 'address','profile_name' ], 'string', 'max' => 100],
            [['account_category_goods','account_category_service'], 'string', 'max' => 1055],
            [['description','keywords'], 'string', 'max' => 2055],
        ];
    }

    public function createAccount(){

        $account = new Account();

        if (!$this->validate()){
            return null;
        }

        $account->full_name=$this->full_name;
        $account->brand_name=$this->brand_name;
        $account->public_status=$this->public_status==null?0:$this->public_status;
        $account->verify_status=$this->verify_status==null?0:$this->verify_status;
        $account->address=$this->address;
        $account->city_id=$account->returnCity_id($this->city_name);
        $account->date_reg=$account->returnDate($this->date);
        $account->created_at=time();
        $account->updated_at=time();
        $account->description=$this->description;
        $account->keywords=$this->keywords;
        $account->legal_address=$this->legal_address;
        $account->director=$this->director;
        $account->email=$this->email;
        $account->phone1=$this->phone1;
        $account->fax=$this->fax;
        $account->inn=$this->inn;
        $account->ogrn=$this->ogrn;
        $account->org_form_id=$this->org_form_id;
        $account->show_main=$this->show_main==null?0:$this->show_main;
        $account->profile_id=$account->returnProfile_id($this->profile_name);
        $account->web_address=$this->web_address;
        $account->rating=100;
        $account->work_time=$this->work_time;


        $account->save();
        if($this->account_category_goods!=null||$this->account_category_service!=null){
            foreach ($account->returnCategoties_id($this->account_category_goods,$this->account_category_service) as $item){
            $category =new AccountCategory();

            $category->category_id=$item;
            $category->account_id=$account->id;

            $category->save();

            }
        }
        
        
    }
    
    
   

}