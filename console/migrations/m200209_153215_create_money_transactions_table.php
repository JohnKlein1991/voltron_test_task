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
            'amount' => $this->integer()->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'company_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'date' => $this->date()->notNull(),
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

        $this->addForeignKey(
            'fk-money_transactions-company_id',
            'money_transactions',
            'company_id',
            'companies',
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
