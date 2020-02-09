<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%money_transactions}}`.
 */
class m200209_153215_create_money_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%money_transactions}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-money_transactions-user_id',
            'money_transactions',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-money_transactions-category_id',
            'money_transactions',
            'category_id',
            'money_transactions_categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%money_transactions}}');
    }
}
