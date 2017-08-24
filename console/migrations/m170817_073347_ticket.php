<?php

use yii\db\Migration;

class m170817_073347_ticket extends Migration
{


    public function safeUp()
    {

        $this->createTable('{{%attachment}}',[
            'id'=>$this->primaryKey(),
            'filePath'=>$this->string()

        ]);

        $this->createTable('{{%ticket}}',[
           'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'profile_id'=>$this->integer(),
            'status'=>$this->integer(),
            'support_id'=>$this->integer(),
        ]);

        $this->createTable('{{%ticket_post}}',[
           'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'support_id'=>$this->integer(),
            'post'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'status'=>$this->integer(),
            'ticket_id'=>$this->integer()
        ]);

        $this->createTable('{{%ticket_post_attach}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'attachment_id'=>$this->integer(),
            'ticket_id'=>$this->integer(),
            'ticket_post_id'=>$this->integer(),

        ]);


        $this->createTable('{{%new_ticket}}',[
            'id'=>$this->primaryKey(),
            'new_ticket_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createIndex('fk_new_ticket_id','{{%new_ticket}}','new_ticket_id');
        $this->addForeignKey('fk_new_ticket_id','{{%new_ticket}}','new_ticket_id','{{%ticket}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_ticket_for_profile_id','{{%new_ticket}}','for_profile_id');
        $this->addForeignKey('fk_new_ticket_for_profile_id','{{%new_ticket}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_ticket_profile_id','{{%ticket}}','profile_id');
        $this->addForeignKey('fk_ticket_profile_id','{{%ticket}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_ticket_support_id','{{%ticket}}','support_id');
        $this->addForeignKey('fk_ticket_support_id','{{%ticket}}','support_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_ticket_post_profile_id','{{%ticket_post}}','profile_id');
        $this->addForeignKey('fk_ticket_post_profile_id','{{%ticket_post}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_ticket_post_support_id','{{%ticket_post}}','support_id');
        $this->addForeignKey('fk_ticket_post_support_id','{{%ticket_post}}','support_id','{{%profile}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_ticket_post_ticket_id','{{%ticket_post}}','ticket_id');
        $this->addForeignKey('fk_ticket_post_ticket_id','{{%ticket_post}}','ticket_id','{{%ticket}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_ticket_post_attach_profile_id','{{%ticket_post_attach}}','profile_id');
        $this->addForeignKey('fk_ticket_post_attach_profile_id','{{%ticket_post_attach}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_ticket_post_id','{{%ticket_post_attach}}','ticket_post_id');
        $this->addForeignKey('fk_ticket_post_id','{{%ticket_post_attach}}','ticket_post_id','{{%ticket_post}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_ticket_post_attachment_id','{{%ticket_post_attach}}','attachment_id');
        $this->addForeignKey('fk_ticket_post_attachment_id','{{%ticket_post_attach}}','attachment_id','{{%attachment}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {

    }

}
