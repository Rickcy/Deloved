<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role_id'=>$this->integer()->defaultValue(3),

        ], $tableOptions);

        $this->createTable('{{%role}}',[
           'id'=>$this->primaryKey(),
           'role_name'=>$this->string()
        ],$tableOptions);
//
        $this->createTable('{{%profile}}',[
             'id'=>$this->primaryKey(),
            'fio'=>$this->string(),
            'email'=>$this->string(),
            'cellPhone'=>$this->string(),
            'avatar_id'=>$this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'chargeStatus'=>$this->integer()->defaultValue(0),
            'chargeTill'=>$this->integer(),
            'user_id'=>$this->integer()
        ],$tableOptions);
        $this->createTable('{{%account}}',[
            'id'=>$this->primaryKey(),
            'full_name'=>$this->string(),
            'org_form_id'=>$this->integer(),
            'brand_name'=>$this->string(),
            'inn'=>$this->string(),
            'kpp'=>$this->string(),
            'legal_address'=>$this->string(),
            'date_reg'=>$this->integer(),
            'phone1'=>$this->string(),
            'phone2'=>$this->string(),
            'fax'=>$this->string(),
            'web_address'=>$this->string(),
            'email'=>$this->string(),
            'logo_id'=>$this->integer(),
            'description'=>$this->string(),
            'director'=>$this->string(),
            'work_time'=>$this->string(),
            'city_name'=>$this->string(),
            'address'=>$this->string(),
            'keywords'=>$this->string(),
            'public_status'=>$this->integer(),
            'verify_status'=>$this->integer(),
            'rating'=>$this->integer(),
            'user_id'=>$this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->insert('role',['id'=>1,'role_name'=>'ROLE_NONE']);
        $this->insert('role',['id'=>2,'role_name'=>'ROLE_USER']);
        $this->insert('role',['id'=>3,'role_name'=>'ROLE_ADMIN']);
        $this->insert('role',['id'=>4,'role_name'=>'ROLE_MANAGER']);
        $this->insert('role',['id'=>5,'role_name'=>'ROLE_JURIST']);
        $this->insert('role',['id'=>6,'role_name'=>'ROLE_JUDGE']);
        $this->insert('role',['id'=>7,'role_name'=>'ROLE_MEDIATOR']);
        $this->insert('role',['id'=>8,'role_name'=>'ROLE_SUPPORT']);


        $this->insert('user',['id'=>1,'username'=>'Rickcy','auth_key'=>Yii::$app->security->generateRandomString(),'password_hash'=>Yii::$app->security->generatePasswordHash('Rickcy27'),
        'password_reset_token'=>null,'email'=>'kuden.and.ko@gmail.com','status'=>10,'role_id'=>3]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%account}}');
    }
}
