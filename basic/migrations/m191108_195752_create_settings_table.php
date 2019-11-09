<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m191108_195752_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'money_max' => Schema::TYPE_STRING . ' NOT NULL',
            'money_min' => Schema::TYPE_STRING . ' NOT NULL',
            'money_limit' => Schema::TYPE_DOUBLE . ' NOT NULL',
            'mana_max' => Schema::TYPE_STRING . ' NOT NULL',
            'mana_min' => Schema::TYPE_STRING . ' NOT NULL',
            'mana_to_money_coef' => Schema::TYPE_DOUBLE . ' NOT NULL'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
