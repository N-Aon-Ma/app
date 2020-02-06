<?php

use yii\db\Migration;

/**
 * Class m200131_150240_add_user
 */
class m200131_150240_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'username' => 'user',
            'auth_key' => '123',
            'password_hash' => '123',
            'password_reset_token' => '',
            'email' => 'admin@mail.ru',

            'status' => 10,
            'created_at' => time(),
            'updated_at' =>  time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_150240_add_user cannot be reverted.\n";

        return false;
    }
    */
}
