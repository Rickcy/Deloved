<?php

use yii\db\Migration;

class m161215_045336_category_product extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%category_type}}',[
            'id'=>$this->primaryKey(),
            'code'=>$this->string(),
        ]);

        $this->insert('category_type',['id'=>1227,'code'=>'GOOD']);
        $this->insert('category_type',['id'=>1342,'code'=>'SERVICE']);


        $this->createTable('{{%category}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'parent_id'=>$this->integer(),
            'categorytype_id'=>$this->integer(),
        ]);

        $this->createIndex('fk_parent_id','{{%category}}','parent_id');
        $this->createIndex('fk_categorytype_id','{{%category}}','categorytype_id');

        $this->addForeignKey('fk_parent_id','{{%category}}','parent_id','{{%category}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_categorytype_id','{{%category}}','categorytype_id','{{%category_type}}','id','CASCADE','CASCADE');


        $this->createTable('{{%account_category}}',[
            'id'=>$this->primaryKey(),
            'account_id'=>$this->integer(),
            'category_id'=>$this->integer()
        ]);

        $this->createTable('{{%measure}}',[
            'id'=>$this->primaryKey(),
            'full_name'=>$this->string()->notNull(),
            'name'=>$this->string()->notNull(),
            'type_id'=>$this->integer()->notNull()
        ]);






        $this->createIndex('fk_type_measure_id','{{%measure}}','type_id');
        $this->addForeignKey('fk_type_measure_id','{{%measure}}','type_id','{{%category_type}}','id','CASCADE','CASCADE');
        
        $this->createIndex('fk_account_id','{{%account_category}}','account_id');
        $this->addForeignKey('fk_account_id','{{%account_category}}','account_id','{{%account}}','id','CASCADE','CASCADE');
        
        $this->createIndex('fk_category_id','{{%account_category}}','category_id');
        $this->addForeignKey('fk_category_id','{{%account_category}}','category_id','{{%category}}','id','CASCADE','CASCADE');
    }

    public function safeDown()
    {
       $this->delete('category');
       $this->delete('category_type');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
