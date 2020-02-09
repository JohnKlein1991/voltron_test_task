<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать компанию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            ['attribute' => 'created_at', 'format' => ['date', 'php:Y-m-d H:i:s']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:Y-m-d H:i:s']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
