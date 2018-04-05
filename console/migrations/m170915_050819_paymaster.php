<?php

use yii\db\Migration;

class m170915_050819_paymaster extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%payment_system}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()
        ]);

        $this->createTable('{{%keeper}}',[
            'id'=>$this->primaryKey(),
            'balance'=>$this->double()->defaultValue(0.00),
            'currency_id'=>$this->integer(),
            'number'=>$this->string(),
            'account_id'=>$this->integer()
        ]);

        $this->createIndex('fk_keeper_currency_id','{{%keeper}}','currency_id');
        $this->addForeignKey('fk_keeper_currency_id','{{%keeper}}','currency_id','{{%currency}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_keeper_account_id','{{%keeper}}','account_id');
        $this->addForeignKey('fk_keeper_account_id','{{%keeper}}','account_id','{{%account}}','id','CASCADE','CASCADE');


        $this->createTable('{{%payment_method}}',[
            'id'=>$this->primaryKey(),
            'code'=>$this->string(),
            'currency_id'=>$this->integer(),
            'enabled'=>$this->boolean()->defaultValue(true),
            'income'=>$this->boolean()->defaultValue(true),
            'name'=>$this->string(),
            'outcome'=>$this->boolean()->defaultValue(false),
            'system_id'=>$this->integer()
        ]);

        $this->createIndex('fk_payment_method_system_id','{{%payment_method}}','system_id');
        $this->addForeignKey('fk_payment_method_system_id','{{%payment_method}}','system_id','{{%payment_system}}','id','CASCADE','CASCADE');


        $this->createTable('{{%payment_request}}',[
            'id'=>$this->primaryKey(),
            'date_created'=>$this->dateTime(),
            'keeper_id'=>$this->integer(),
            'last_updated'=>$this->dateTime(),
            'method_id'=>$this->integer(),
            'account_id'=>$this->integer(),
            'status'=>$this->integer(),
            'value'=>$this->double()
        ]);


        $this->createIndex('fk_payment_request_keeper_id','{{%payment_request}}','keeper_id');
        $this->addForeignKey('fk_payment_request_keeper_id','{{%payment_request}}','keeper_id','{{%keeper}}','id','CASCADE','CASCADE');


        $this->createIndex('fk_payment_request_method_id','{{%payment_request}}','method_id');
        $this->addForeignKey('fk_payment_request_method_id','{{%payment_request}}','method_id','{{%payment_method}}','id','CASCADE','CASCADE');

        $this->createIndex('fk_payment_request_account_id','{{%payment_request}}','account_id');
        $this->addForeignKey('fk_payment_request_account_id','{{%payment_request}}','account_id','{{%account}}','id','CASCADE','CASCADE');

        $this->insert('payment_system',['name'=>'Служебная']);
        $this->insert('payment_system',['name'=>'Paymaster']);


        $this->insert('payment_method',['code'=>'INCOME_MANUAL','name'=>'Оплата по счету','system_id'=>1]);
        $this->insert('payment_method',['code'=>'0','name'=>'PayMaster','system_id'=>2]);
        $this->insert('payment_method',['code'=>'EuroSet','name'=>'Евросеть','system_id'=>2]);
        $this->insert('payment_method',['code'=>'AlfaBank','name'=>'Альфа-Банк','system_id'=>2]);
        $this->insert('payment_method',['code'=>'RSB','name'=>'Банк Русский Стандарт','system_id'=>2]);
        $this->insert('payment_method',['code'=>'Yandex','name'=>'Яндекс.Деньги','system_id'=>2]);
        $this->insert('payment_method',['code'=>'WebMoney','name'=>'WebMoney','system_id'=>2]);
        $this->insert('payment_method',['code'=>'Contact','name'=>'Контакт','system_id'=>2]);

    }

    public function safeDown()
    {
        $this->dropTable('{{%payment_request}}');
        $this->dropTable('{{%payment_method}}');
        $this->dropTable('{{%keeper}}');
        $this->dropTable('{{%payment_system}}');
    }
 }
