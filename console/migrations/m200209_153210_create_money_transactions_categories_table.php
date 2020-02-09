<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%money_transactions_categories}}`.
 */
class m200209_153210_create_money_transactions_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%money_transactions_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-money_transactions_categories-user_id',
            'money_transactions_categories',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%money_transactions_categories}}');
    }
}
