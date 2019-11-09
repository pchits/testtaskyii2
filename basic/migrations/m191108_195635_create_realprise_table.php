<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%realprise}}`.
 */
class m191108_195635_create_realprise_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%real_prise}}', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%real_prise}}');
    }
}
