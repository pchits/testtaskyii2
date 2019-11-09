<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%game}}`.
 */
class m191109_104145_create_game_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%game}}', [
            'id' => $this->primaryKey(),
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prise_type' => Schema::TYPE_STRING . ' NOT NULL',
            'prise_value' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prise_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%game}}');
    }
}
