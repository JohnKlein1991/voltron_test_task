<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\MoneyTransaction;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="money-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить транзакцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'amount',
                'label' => 'Сумма'
            ],
            [
                'attribute' => 'Категория',
                'value' => 'category.title'
            ],
            [
                'attribute' => 'type',
                'label' => 'Тип',
                'value' => function($data) {
                    if ($data->type === MoneyTransaction::$TYPE_REVENUE) {
                        return 'Доход';
                    } else if ($data->type === MoneyTransaction::$TYPE_EXPENSE) {
                        return 'Расход';
                    } else {
                        return false;
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Дата изменения',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
