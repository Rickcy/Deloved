<?php

use yii\db\Migration;

class m170928_160444_new_deal extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%new_deal_post}}',[
            'id'=>$this->primaryKey(),
            'deal_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_deal_post_deal_id','{{%new_deal_post}}','deal_id');
        $this->addForeignKey('fk_new_deal_post_deal_id','{{%new_deal_post}}','deal_id','{{%deal}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_deal_post_for_profile_id','{{%new_deal_post}}','for_profile_id');
        $this->addForeignKey('fk_new_deal_post_for_profile_id','{{%new_deal_post}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');

    }

    public function safeDown()
    {

    }

}
