<?php

use yii\db\Migration;

class m170814_091607_new_item extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {

        $this->createTable('{{%new_account}}',[
            'id'=>$this->primaryKey(),
            'new_account_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_account_id','{{%new_account}}','new_account_id');
        $this->addForeignKey('fk_new_account_id','{{%new_account}}','new_account_id','{{%account}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_new_account_for_profile_id','{{%new_account}}','for_profile_id');
        $this->addForeignKey('fk_new_account_for_profile_id','{{%new_account}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createTable('{{%new_suggestion}}',[
            'id'=>$this->primaryKey(),
            'new_suggestion_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_suggestion_id','{{%new_suggestion}}','new_suggestion_id');
        $this->addForeignKey('fk_new_suggestion_id','{{%new_suggestion}}','new_suggestion_id','{{%suggestion}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_new_suggestion_for_profile_id','{{%new_suggestion}}','for_profile_id');
        $this->addForeignKey('fk_new_suggestion_for_profile_id','{{%new_suggestion}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');




        $this->createTable('{{%new_good}}',[
            'id'=>$this->primaryKey(),
            'account_id'=>$this->integer(),
            'new_good_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_good_who_account_id','{{%new_good}}','account_id');
        $this->addForeignKey('fk_who_account_id','{{%new_good}}','account_id','{{%account}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_new_good_for_profile_id','{{%new_good}}','for_profile_id');
        $this->addForeignKey('fk_new_good_for_profile_id','{{%new_good}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_good_id','{{%new_good}}','new_good_id');
        $this->addForeignKey('fk_new_good_id','{{%new_good}}','new_good_id','{{%goods}}','id','CASCADE','CASCADE');



        $this->createTable('{{%new_service}}',[
            'id'=>$this->primaryKey(),
            'account_id'=>$this->integer(),
            'new_service_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_service_who_account_id','{{%new_service}}','account_id');
        $this->addForeignKey('fk_who_account_id','{{%new_service}}','account_id','{{%account}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_new_service_for_profile_id','{{%new_service}}','for_profile_id');
        $this->addForeignKey('fk_new_service_for_profile_id','{{%new_service}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_service_id','{{%new_service}}','new_service_id');
        $this->addForeignKey('fk_new_service_id','{{%new_service}}','new_service_id','{{%services}}','id','CASCADE','CASCADE');




    }

    public function safeDown()
    {
        $this->dropTable('{{new_account}}');
        $this->dropTable('{{new_service}}');
        $this->dropTable('{{new_good}}');
        $this->dropTable('{{new_suggestion}}');
    }

}
