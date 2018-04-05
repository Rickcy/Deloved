<?php

use yii\db\Migration;

class m170928_075728_account_rating extends Migration
{

    public function safeUp()
    {

        $this->createTable('{{%account_rating}}',[
            'id'=>$this->primaryKey(),
            'account_id'=>$this->integer(),
            'claim'=>$this->integer(),
            'dispute'=>$this->integer(),
            'review'=>$this->integer(),
            'deal_id'=>$this->integer(),
            'deal_fail'=>$this->integer(),
            'deal_success'=>$this->integer(),
        ]);

        $this->createIndex('fk_account_deal_rating_account_id','{{%account_rating}}','account_id');
        $this->addForeignKey('fk_account_deal_rating_account_id','{{%account_rating}}','account_id','{{%account}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_account_deal_rating_deal_id','{{%account_rating}}','deal_id');
        $this->addForeignKey('fk_account_deal_rating_deal_id','{{%account_rating}}','deal_id','{{%deal}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {
    }

}
