<?php

use yii\db\Migration;

class m171002_142851_new_review extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%review}}',[
            'id'=>$this->primaryKey(),
            'author_id'=>$this->integer(),
            'about_id'=>$this->integer(),
            'deal_id'=>$this->integer(),
            'content'=>$this->string(),
            'date_created'=>$this->dateTime(),
            'date_published'=>$this->dateTime(),
            'published'=>$this->boolean(),
            'value'=>$this->integer(),
            'remark'=>$this->string(),
        ]);



        $this->execute("ALTER TABLE review ALTER COLUMN content TYPE TEXT USING content::TEXT;");
        $this->execute("ALTER TABLE review ALTER COLUMN remark TYPE TEXT USING content::TEXT;");

        $this->createIndex('fk_review_deal_id','{{%review}}','deal_id');
        $this->addForeignKey('fk_review_deal_id','{{%review}}','deal_id','{{%deal}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_review_about_id','{{%review}}','about_id');
        $this->addForeignKey('fk_review_about_id','{{%review}}','about_id','{{%account}}','id','CASCADE','CASCADE');



        $this->createIndex('fk_review_author_id','{{%review}}','author_id');
        $this->addForeignKey('fk_review_author_id','{{%review}}','author_id','{{%account}}','id','CASCADE','CASCADE');


        $this->createTable('{{%new_review}}',[
            'id'=>$this->primaryKey(),
            'new_review_id'=>$this->integer(),
            'for_profile_id'=>$this->integer(),
            'date_created'=>$this->dateTime()
        ]);


        $this->createIndex('fk_new_review_author_id','{{%new_review}}','new_review_id');
        $this->addForeignKey('fk_new_review_author_id','{{%new_review}}','new_review_id','{{%review}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_new_review_for_profile_id','{{%new_review}}','for_profile_id');
        $this->addForeignKey('fk_new_review_for_profile_id','{{%new_review}}','for_profile_id','{{%profile}}','id','CASCADE','CASCADE');


    }

    public function safeDown()
    {

    }

}
