<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransactionsCategory */

$this->title = 'Создание новой категории доходов/расходов';
$this->params['breadcrumbs'][] = ['label' => 'Категории доходов/расходов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="money-transactions-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
