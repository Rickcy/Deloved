<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%role}}',[
            'id'=>$this->primaryKey(),
            'role_name'=>$this->string()
        ],$tableOptions);


        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email_confirm_token'=>$this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'role_id'=>$this->integer()->defaultValue(1),


        ], $tableOptions);



        $this->createTable('{{%profile}}',[
             'id'=>$this->primaryKey(),
            'fio'=>$this->string(),
            'email'=>$this->string(),
            'avatar_id'=>$this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'chargeStatus'=>$this->integer()->defaultValue(0),
            'chargeTill'=>$this->integer(),
            'user_id'=>$this->integer(),

        ],$tableOptions);




        $this->createTable('{{%account}}',[
            'id'=>$this->primaryKey(),
            'full_name'=>$this->string(),
            'org_form_id'=>$this->integer(),
            'brand_name'=>$this->string(),
            'inn'=>$this->string(),
            'ogrn'=>$this->string(),
            'legal_address'=>$this->string(),
            'date_reg'=>$this->integer(),
            'phone1'=>$this->string(),
            'fax'=>$this->string(),
            'web_address'=>$this->string(),
            'email'=>$this->string(),
            'description'=>$this->string(),
            'director'=>$this->string(),
            'work_time'=>$this->string(),
            'city_id'=>$this->integer(),
            'address'=>$this->string(),
            'keywords'=>$this->string(),
            'public_status'=>$this->integer()->defaultValue(0),
            'verify_status'=>$this->integer()->defaultValue(0),
            'show_main'=>$this->integer()->defaultValue(0),
            'rating'=>$this->integer()->defaultValue(100),
            'profile_id'=>$this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ],$tableOptions);


        $this->createTable('{{%org_form}}',[
            'id'=>$this->primaryKey(),
            'code'=>$this->string(),
            'name'=>$this->string(),
        ]);

        $this->createTable('{{%logo}}',[
            'id'=>$this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'image_name'=>$this->string(),
            'file'=>$this->string(),
            'main_image'=>$this->integer()->defaultValue(0),
            'user_id'=>$this->integer()
        ],$tableOptions);

        $this->createTable('{{affiliate}}',[
            'id'=>$this->primaryKey(),
            'address'=>$this->string(),
            'city_id'=>$this->integer(),
            'email'=>$this->string(),
            'phone'=>$this->string(),
            'account_id'=>$this->integer()
        ],$tableOptions);

        $this->createIndex('fk_affiliate_account_id','{{%affiliate}}','account_id');
        $this->addForeignKey('fk_affiliate_account_id','{{%affiliate}}','account_id','{{%account}}','id','SET NULL','CASCADE');
        
        $this->createIndex('fk_role_id','{{%user}}','role_id');
        $this->addForeignKey('fk_role_id','{{%user}}','role_id','{{%role}}','id','SET NULL','CASCADE');

        $this->createIndex('fk_org_form_id','{{%account}}','org_form_id');
        $this->addForeignKey('fk_org_form_id','{{%account}}','org_form_id','{{%org_form}}','id','SET NULL','CASCADE');
        
        $this->createIndex('fk_acc_id','{{%account}}','profile_id');
        $this->addForeignKey('fk_acc_id','{{%account}}','profile_id','{{%profile}}','id','SET NULL','CASCADE');


        $this->createIndex('fk_user_logo_id','{{%logo}}','user_id');
        
        $this->addForeignKey('fk_user_logo_id','{{%logo}}','user_id','{{%account}}','id','SET NULL','CASCADE');
        

       
        
        $this->createIndex('fk_user_id','{{%profile}}','user_id');
        $this->addForeignKey('fk_user_id','{{%profile}}','user_id','{{%user}}','id','SET NULL','CASCADE');

        $this->insert('role',['id'=>1,'role_name'=>'ROLE_NONE']);
        $this->insert('role',['id'=>2,'role_name'=>'ROLE_USER']);
        $this->insert('role',['id'=>3,'role_name'=>'ROLE_ADMIN']);
        $this->insert('role',['id'=>4,'role_name'=>'ROLE_MANAGER']);
        $this->insert('role',['id'=>5,'role_name'=>'ROLE_JURIST']);
        $this->insert('role',['id'=>6,'role_name'=>'ROLE_JUDGE']);
        $this->insert('role',['id'=>7,'role_name'=>'ROLE_MEDIATOR']);
        $this->insert('role',['id'=>8,'role_name'=>'ROLE_SUPPORT']);


        $this->insert('org_form',['id'=>1,'code'=>'ИП', 'name'=>'Индивидуальный предприниматель']);
        $this->insert('org_form',['id'=>2,'code'=>'ООО','name'=>'Общество с ограниченной ответственностью']);
        $this->insert('org_form',['id'=>3,'code'=>'ОАО','name'=>'Открытое акционерное общество']);
        $this->insert('org_form',['id'=>4,'code'=>'ПАО','name'=>'Публичное акционерное общество']);
        $this->insert('org_form',['id'=>5,'code'=>'ЗАО','name'=>'Закрытое акционерное общество']);

        //  ADMIN
        $this->insert('user',['id'=>1,'username'=>'admin','auth_key'=>Yii::$app->security->generateRandomString(),'password_hash'=>Yii::$app->security->generatePasswordHash('delo22221111ved'),'password_reset_token'=>null,
        'email_confirm_token'=>null,'email'=>'Rickcy@mail.com','status'=>1,'role_id'=>3]);
        $this->insert('profile',['id'=>1,'fio'=>'Администратор','email'=>'Rickcy@mail.com','avatar_id'=>null,'created_at'=>time(),'updated_at'=>time(),'chargeStatus'=>1,'chargeTill'=>null,'user_id'=>1]);

        
        
    }

    public function safeDown()
    {
        $this->dropColumn('profile',1);
        $this->dropColumn('user',1);
        $this->dropColumn('org_form',5);
        $this->dropColumn('org_form',4);
        $this->dropColumn('org_form',3);
        $this->dropColumn('org_form',2);
        $this->dropColumn('org_form',1);
        $this->dropColumn('role',8);
        $this->dropColumn('role',7);
        $this->dropColumn('role',6);
        $this->dropColumn('role',5);
        $this->dropColumn('role',4);
        $this->dropColumn('role',3);
        $this->dropColumn('role',2);
        $this->dropColumn('role',1);
        $this->dropTable('{{%affiliate}}');
        $this->dropTable('{{%logo}}');
        $this->dropTable('{{%org_form}}');
        $this->dropTable('{{%account}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%role}}');

    }
}
