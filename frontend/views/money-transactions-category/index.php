<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории доходов/расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="money-transactions-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'user_id',
            'type',
            ['attribute' => 'created_at', 'format' => ['date', 'php:Y-m-d H:i:s']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:Y-m-d H:i:s']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
