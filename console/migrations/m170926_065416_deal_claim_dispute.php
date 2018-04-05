<?php

use yii\db\Migration;

class m170926_065416_deal_claim_dispute extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('{{%deal}}',[
            'id'=>$this->primaryKey(),
            'failed_by_id'=>$this->integer(),
            'date_created'=>$this->dateTime(),
            'buyer_id'=>$this->integer(),
            'seller_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);

        $this->createTable('{{%claim}}',[
            'id'=>$this->primaryKey(),
            'failed_by_id'=>$this->integer(),
            'date_created'=>$this->dateTime(),
            'profile_id'=>$this->integer(),
            'partner_id'=>$this->integer(),
            'deal_id'=>$this->integer(),
            'judge_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);

        $this->createTable('{{%dispute}}',[
            'id'=>$this->primaryKey(),
            'failed_by_id'=>$this->integer(),
            'date_created'=>$this->dateTime(),
            'profile_id'=>$this->integer(),
            'partner_id'=>$this->integer(),
            'deal_id'=>$this->integer(),
            'mediator_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);


        $this->createTable('{{%claim_post}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'post'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'claim_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);

        $this->createTable('{{%dispute_post}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'post'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'dispute_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);

        $this->execute("ALTER TABLE claim_post ALTER COLUMN post TYPE TEXT USING post::TEXT;");

        $this->execute("ALTER TABLE dispute_post ALTER COLUMN post TYPE TEXT USING post::TEXT;");

        $this->createTable('{{%deal_post}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'post'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'deal_id'=>$this->integer(),
            'claim_id'=>$this->integer(),
            'dispute_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);
        $this->execute("ALTER TABLE deal_post ALTER COLUMN post TYPE TEXT USING post::TEXT;");



        $this->createTable('{{%deal_post_attach}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'attachment_id'=>$this->integer(),
            'deal_id'=>$this->integer(),
            'deal_post_id'=>$this->integer(),

        ]);


        $this->createTable('{{%claim_post_attach}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'attachment_id'=>$this->integer(),
            'claim_id'=>$this->integer(),
            'claim_post_id'=>$this->integer(),

        ]);

        $this->createTable('{{%dispute_post_attach}}',[
            'id'=>$this->primaryKey(),
            'profile_id'=>$this->integer(),
            'attachment_id'=>$this->integer(),
            'dispute_id'=>$this->integer(),
            'dispute_post_id'=>$this->integer(),

        ]);

        $this->createTable('{{%new_claim}}',[
            'id'=>$this->primaryKey(),
            'new_claim_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createTable('{{%new_dispute}}',[
            'id'=>$this->primaryKey(),
            'new_dispute_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);

        $this->createTable('{{%new_deal}}',[
            'id'=>$this->primaryKey(),
            'new_deal_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_deal_id','{{%new_deal}}','new_deal_id');
        $this->addForeignKey('fk_new_deal_id','{{%new_deal}}','new_deal_id','{{%deal}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_claim_id','{{%new_claim}}','new_claim_id');
        $this->addForeignKey('fk_new_claim_id','{{%new_claim}}','new_claim_id','{{%claim}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_dispute_id','{{%new_dispute}}','new_dispute_id');
        $this->addForeignKey('fk_new_dispute_id','{{%new_dispute}}','new_dispute_id','{{%dispute}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_new_deal_for_profile_id','{{%new_deal}}','for_profile_id');
        $this->addForeignKey('fk_new_deal_for_profile_id','{{%new_deal}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_claim_for_profile_id','{{%new_claim}}','for_profile_id');
        $this->addForeignKey('fk_new_claim_for_profile_id','{{%new_claim}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_new_dispute_for_profile_id','{{%new_dispute}}','for_profile_id');
        $this->addForeignKey('fk_new_dispute_for_profile_id','{{%new_dispute}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_buyer_id','{{%deal}}','buyer_id');
        $this->addForeignKey('fk_deal_buyer_id','{{%deal}}','buyer_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_claim_profile_id','{{%claim}}','profile_id');
        $this->addForeignKey('fk_claim_profile_id','{{%claim}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_dispute_profile_id','{{%dispute}}','profile_id');
        $this->addForeignKey('fk_dispute_profile_id','{{%dispute}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_seller_id','{{%deal}}','seller_id');
        $this->addForeignKey('fk_deal_seller_id','{{%deal}}','seller_id','{{%profile}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_claim_partner_id','{{%claim}}','partner_id');
        $this->addForeignKey('fk_claim_partner_id','{{%claim}}','partner_id','{{%profile}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_dispute_partner_id','{{%dispute}}','partner_id');
        $this->addForeignKey('fk_dispute_partner_id','{{%dispute}}','partner_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_failed_by_id','{{%deal}}','failed_by_id');
        $this->addForeignKey('fk_deal_failed_by_id','{{%deal}}','failed_by_id','{{%profile}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_claim_failed_by_id','{{%claim}}','failed_by_id');
        $this->addForeignKey('fk_claim_failed_by_id','{{%claim}}','failed_by_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_dispute_failed_by_id','{{%dispute}}','failed_by_id');
        $this->addForeignKey('fk_dispute_failed_by_id','{{%dispute}}','failed_by_id','{{%profile}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_deal_post_profile_id','{{%deal_post}}','profile_id');
        $this->addForeignKey('fk_deal_post_profile_id','{{%deal_post}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_claim_post_profile_id','{{%claim_post}}','profile_id');
        $this->addForeignKey('fk_claim_post_profile_id','{{%claim_post}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_dispute_post_profile_id','{{%dispute_post}}','profile_id');
        $this->addForeignKey('fk_dispute_post_profile_id','{{%dispute_post}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_post_deal_id','{{%deal_post}}','deal_id');
        $this->addForeignKey('fk_deal_post_deal_id','{{%deal_post}}','deal_id','{{%deal}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_claim_post_deal_id','{{%claim_post}}','claim_id');
        $this->addForeignKey('fk_claim_post_deal_id','{{%claim_post}}','claim_id','{{%claim}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_dispute_post_deal_id','{{%dispute_post}}','dispute_id');
        $this->addForeignKey('fk_dispute_post_deal_id','{{%dispute_post}}','dispute_id','{{%dispute}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_post_claim_id','{{%deal_post}}','claim_id');
        $this->addForeignKey('fk_deal_post_claim_id','{{%deal_post}}','claim_id','{{%claim}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_deal_post_dispute_id','{{%deal_post}}','dispute_id');
        $this->addForeignKey('fk_deal_post_dispute_id','{{%deal_post}}','dispute_id','{{%dispute}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_deal_post_attach_profile_id','{{%deal_post_attach}}','profile_id');
        $this->addForeignKey('fk_deal_post_attach_profile_id','{{%deal_post_attach}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_claim_post_attach_profile_id','{{%claim_post_attach}}','profile_id');
        $this->addForeignKey('fk_claim_post_attach_profile_id','{{%claim_post_attach}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_dispute_post_attach_profile_id','{{%dispute_post_attach}}','profile_id');
        $this->addForeignKey('fk_dispute_post_attach_profile_id','{{%dispute_post_attach}}','profile_id','{{%profile}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_deal_post_id','{{%deal_post_attach}}','deal_post_id');
        $this->addForeignKey('fk_deal_post_id','{{%deal_post_attach}}','deal_post_id','{{%deal_post}}','id','CASCADE','CASCADE');




        $this->createIndex('fk_claim_post_id','{{%claim_post_attach}}','claim_post_id');
        $this->addForeignKey('fk_claim_post_id','{{%claim_post_attach}}','claim_post_id','{{%claim_post}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_dispute_post_id','{{%dispute_post_attach}}','dispute_post_id');
        $this->addForeignKey('fk_dispute_post_id','{{%dispute_post_attach}}','dispute_post_id','{{%dispute_post}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_deal_post_attachment_id','{{%deal_post_attach}}','attachment_id');
        $this->addForeignKey('fk_deal_post_attachment_id','{{%deal_post_attach}}','attachment_id','{{%attachment}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_claim_post_attachment_id','{{%claim_post_attach}}','attachment_id');
        $this->addForeignKey('fk_claim_post_attachment_id','{{%claim_post_attach}}','attachment_id','{{%attachment}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_dispute_post_attachment_id','{{%dispute_post_attach}}','attachment_id');
        $this->addForeignKey('fk_dispute_post_attachment_id','{{%dispute_post_attach}}','attachment_id','{{%attachment}}','id','CASCADE','CASCADE');





    }

    public function safeDown()
    {


    }

}
