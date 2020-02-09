<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MoneyTransactionsCategory;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransactionsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="money-transactions-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList([
        MoneyTransactionsCategory::$TYPE_REVENUE => 'Доход',
        MoneyTransactionsCategory::$TYPE_EXPENSE => 'Расход',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
