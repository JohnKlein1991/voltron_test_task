<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransaction */
/** @var $dataForSelectTypes array */
/** @var $dataForSelectCategories array */

$this->title = 'Update Money Transaction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Money Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="money-transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataForSelectTypes' => $dataForSelectTypes,
        'dataForSelectCategories' => $dataForSelectCategories,
    ]) ?>

</div>
