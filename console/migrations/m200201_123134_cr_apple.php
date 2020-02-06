<?php

use yii\db\Migration;

/**
 * Class m200201_123134_cr_apple
 */
class m200201_123134_cr_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(),
            'date_create' => $this->integer()->notNull(),
            'date_fall' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
            'size' => $this->float()->defaultValue(1),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%apple}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200201_123134_cr_apple cannot be reverted.\n";

        return false;
    }
    */
}
