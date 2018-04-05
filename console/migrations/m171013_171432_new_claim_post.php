<?php

use yii\db\Migration;

class m171013_171432_new_claim_post extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%new_claim_post}}',[
            'id'=>$this->primaryKey(),
            'claim_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_claim_post_dispute_id','{{%new_claim_post}}','claim_id');
        $this->addForeignKey('fk_new_claim_post_dispute_id','{{%new_claim_post}}','claim_id','{{%claim}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_claim__post_for_profile_id','{{%new_claim_post}}','for_profile_id');
        $this->addForeignKey('fk_new_claim__post_for_profile_id','{{%new_claim_post}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {
    }

}
