<?php

use frontend\models\MoneyTransaction;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransaction */

$this->title = $model->amount;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="money-transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить транзакцию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'amount',
                'label' => 'Сумма'
            ],
            [
                'attribute' => 'category.title',
                'label' => 'Название категории'
            ],
            [
                'attribute' => 'type',
                'value' => function() use ($model) {
                    if ($model->type === MoneyTransaction::$TYPE_REVENUE) {
                        return 'Доход';
                    } else if ($model->type === MoneyTransaction::$TYPE_EXPENSE) {
                        return 'Расход';
                    } else {
                        return false;
                    }
                },
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
        ],
    ]) ?>

</div>
