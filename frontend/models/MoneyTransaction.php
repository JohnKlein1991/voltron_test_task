<?php

namespace frontend\models;

use common\models\User;

/**
 * This is the model class for table "money_transactions".
 *
 * @property int $id
 * @property int $amount
 * @property int|null $category_id
 * @property int $user_id
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 *
 * @property MoneyTransactionsCategory $category
 * @property User $user
 */
class MoneyTransaction extends \yii\db\ActiveRecord
{
    /**
     * Тип - доход
     * @var int
     */
    public static $TYPE_REVENUE = 1;
    /**
     * Тип - расход
     * @var int
     */
    public static $TYPE_EXPENSE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'money_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'user_id', 'type', 'created_at', 'updated_at'], 'required'],
            [['amount', 'category_id', 'user_id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => MoneyTransactionsCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MoneyTransactionsCategory::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
