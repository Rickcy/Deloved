<?php

use yii\db\Migration;

class m161206_094853_regions extends Migration
{
    public function up()
    {
        $this->execute("
        SELECT setval('user_id_seq',2);
        ");
        $this->execute("
        SELECT setval('profile_id_seq',2);
        ");
        $this->execute("
        SELECT setval('experience_id_seq',2);
        ");
        $this->execute("
        SELECT setval('profile_region_id_seq',2);
        ");

        $this->createTable('{{%region_type}}',[
            'id'=>$this->primaryKey(),
            'code'=>$this->string()
        ]);

        $this->insert('region_type',['id'=>1,'code'=>'COUNTRY']);
        $this->insert('region_type',['id'=>2,'code'=>'REGION']);
        $this->insert('region_type',['id'=>3,'code'=>'CITY']);


        $this->createTable('{{%region_level}}',[
            'id'=>$this->primaryKey(),
            'level'=>$this->integer(),
            'parent_id'=>$this->integer(),
            'type_id'=>$this->integer()
        ]);

        $this->createIndex('fk_region_level_parent_id','{{%region_level}}','parent_id');
        $this->createIndex('fk_region_level_type_id','{{%region_level}}','type_id');

        $this->addForeignKey('fk_region_level_parent_id','{{%region_level}}','parent_id','{{%region_level}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_region_level_type_id','{{%region_level}}','type_id','{{%region_type}}','id','CASCADE','CASCADE');



        $this->insert('region_level',['id'=>16,'level'=>1,'parent_id'=>null,'type_id'=>1]);
        $this->insert('region_level',['id'=>17,'level'=>2,'parent_id'=>16,'type_id'=>2]);
        $this->insert('region_level',['id'=>18,'level'=>3,'parent_id'=>17,'type_id'=>3]);


        $this->createTable('{{%region}}',[
            'id'=>$this->primaryKey(),
            'full_name'=>$this->string(),
            'level_id'=>$this->integer(),
            'name'=>$this->string(),
            'parent_id'=>$this->integer(),
        ]);
        $this->createIndex('fk_region_level_id','{{%region}}','level_id');
        $this->createIndex('fk_region_parent_id','{{%region}}','parent_id');


        $this->addForeignKey('fk_region_level_id','{{%region}}','level_id','{{%region_level}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_region_parent_id','{{%region}}','parent_id','{{%region}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_account_city_id','{{%account}}','city_id');
        $this->addForeignKey('fk_account_city_id','{{%account}}','city_id','{{%region}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_profile_city_id_profile','{{%profile}}','city_id');
        $this->addForeignKey('fk_profile_city_id_profile','{{%profile}}','city_id','{{%region}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_affiliate_city_id_affiliate','{{%affiliate}}','city_id');
        $this->addForeignKey('fk_affiliate_city_id_affiliate','{{%affiliate}}','city_id','{{%region}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_profile_region_region_id','{{%profile_region}}','region_id');
        $this->addForeignKey('fk_profile_region_region_id','{{%profile_region}}','region_id','{{%region}}','id','CASCADE','CASCADE');



    }

    public function down()
    {
        $this->dropTable('region');
        $this->dropTable('region_level');
        $this->dropTable('region_type');

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
