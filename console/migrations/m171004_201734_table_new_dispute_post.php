<?php

use yii\db\Migration;

class m171004_201734_table_new_dispute_post extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%new_dispute_post}}',[
            'id'=>$this->primaryKey(),
            'dispute_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_dispute_post_dispute_id','{{%new_dispute_post}}','dispute_id');
        $this->addForeignKey('fk_new_dispute_post_dispute_id','{{%new_dispute_post}}','dispute_id','{{%dispute}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_dispute_post_for_profile_id','{{%new_dispute_post}}','for_profile_id');
        $this->addForeignKey('fk_new_dispute_post_for_profile_id','{{%new_dispute_post}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');

    }

    public function safeDown()
    {

    }
}
