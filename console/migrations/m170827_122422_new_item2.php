<?php

use yii\db\Migration;

class m170827_122422_new_item2 extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%new_ticket_post}}',[
            'id'=>$this->primaryKey(),
            'ticket_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_ticket_post_ticket_id','{{%new_ticket_post}}','ticket_id');
        $this->addForeignKey('fk_new_ticket_post_ticket_id','{{%new_ticket_post}}','ticket_id','{{%ticket}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_ticket_post_for_profile_id','{{%new_ticket_post}}','for_profile_id');
        $this->addForeignKey('fk_new_ticket_post_for_profile_id','{{%new_ticket_post}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createTable('{{%consult}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'profile_id'=>$this->integer(),
            'status'=>$this->integer(),
            'jurist_id'=>$this->integer(),
        ]);

        $this->createTable('{{%consult_post}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'post'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'status'=>$this->integer(),
            'consult_id'=>$this->integer()
        ]);

        $this->execute("ALTER TABLE consult_post ALTER COLUMN post TYPE TEXT USING post::TEXT;");

        $this->createTable('{{%consult_post_attach}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'attachment_id'=>$this->integer(),
            'consult_id'=>$this->integer(),
            'consult_post_id'=>$this->integer(),

        ]);


        $this->createTable('{{%new_consult}}',[
            'id'=>$this->primaryKey(),
            'new_consult_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_consult_id','{{%new_consult}}','new_consult_id');
        $this->addForeignKey('fk_new_consult_id','{{%new_consult}}','new_consult_id','{{%consult}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_consult_for_profile_id','{{%new_consult}}','for_profile_id');
        $this->addForeignKey('fk_new_consult_for_profile_id','{{%new_consult}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_consult_profile_id','{{%consult}}','profile_id');
        $this->addForeignKey('fk_consult_profile_id','{{%consult}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_consult_jurist_id','{{%consult}}','jurist_id');
        $this->addForeignKey('fk_consult_jurist_id','{{%consult}}','jurist_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_consult_post_profile_id','{{%consult_post}}','profile_id');
        $this->addForeignKey('fk_consult_post_profile_id','{{%consult_post}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_consult_post_consult_id','{{%consult_post}}','consult_id');
        $this->addForeignKey('fk_consult_post_consult_id','{{%consult_post}}','consult_id','{{%consult}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_consult_post_attach_profile_id','{{%consult_post_attach}}','profile_id');
        $this->addForeignKey('fk_consult_post_attach_profile_id','{{%consult_post_attach}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_consult_post_id','{{%consult_post_attach}}','consult_post_id');
        $this->addForeignKey('fk_consult_post_id','{{%consult_post_attach}}','consult_post_id','{{%consult_post}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_consult_post_attachment_id','{{%consult_post_attach}}','attachment_id');
        $this->addForeignKey('fk_consult_post_attachment_id','{{%consult_post_attach}}','attachment_id','{{%attachment}}','id','CASCADE','CASCADE');



        $this->createTable('{{%new_consult_post}}',[
            'id'=>$this->primaryKey(),
            'consult_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_consult_post_ticket_id','{{%new_consult_post}}','consult_id');
        $this->addForeignKey('fk_new_consult_post_ticket_id','{{%new_consult_post}}','consult_id','{{%consult}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_consult_post_for_profile_id','{{%new_consult_post}}','for_profile_id');
        $this->addForeignKey('fk_new_consult_post_for_profile_id','{{%new_consult_post}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {
    }

}
