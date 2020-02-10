<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "money_transactions_categories".
 *
 * @property int $id
 * @property string|null $title
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property MoneyTransaction[] $moneyTransactions
 * @property User $user
 */
class MoneyTransactionsCategory extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'money_transactions_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 250],
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
            'title' => 'Название',
            'user_id' => 'ID создателя',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[MoneyTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoneyTransactions()
    {
        return $this->hasMany(MoneyTransaction::class, ['category_id' => 'id']);
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

    public static function getCategoriesByUserId($userId)
    {
        return self::find()
            ->select(['id', 'title'])
            ->where("user_id = $userId")
            ->asArray()
            ->all();
    }
}
