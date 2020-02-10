<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransaction */
/* @var $form yii\widgets\ActiveForm */
/** @var $dataForSelectTypes array */
/** @var $dataForSelectCategories array */
?>

<div class="money-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->label('Сумма')->textInput() ?>

    <?= $form->field($model, 'category_id')->label('Название категории')->dropDownList($dataForSelectCategories) ?>

    <?= $form->field($model, 'type')->label('Тип')->dropDownList($dataForSelectTypes) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
