<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransaction */
/** @var $dataForSelectTypes array */
/** @var $dataForSelectCategories array */

$this->title = 'Создать транзакцию';
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="money-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataForSelectTypes' => $dataForSelectTypes,
        'dataForSelectCategories' => $dataForSelectCategories,
    ]) ?>

</div>
