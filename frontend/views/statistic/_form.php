<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MoneyTransaction */
/* @var $form yii\widgets\ActiveForm */
/** @var $dataForSelectTypes array */
/** @var $dataForSelectCategories array */
/** @var $dataForSelectCompanies array */
/** @var $dataForGroupBySelect array */
?>

<div class="statistic-form">

    <?php $form = ActiveForm::begin([
        'id' => 'create_statistic_form',
        'action' => '/statistic',
        'enableAjaxValidation' => true,
        'validationUrl' => '/statistic/validate',
    ]); ?>

    <?= $form->field($model, 'date_from')->label('Дата от')->textInput(['id' => 'datepickerFrom']) ?>

    <?= $form->field($model, 'date_to')->label('Дата до')->textInput(['id' => 'datepickerTo']) ?>

    <?= $form->field($model, 'group_by')->label('Группировать по')->dropDownList($dataForGroupBySelect) ?>

    <?= $form->field($model, 'category_id')->label('Название категории')->dropDownList(
        $dataForSelectCategories,
        [
            'options' => [
                0 => ['selected' => 'true']
            ]
        ]
    ) ?>

    <?= $form->field($model, 'company_id')->label('Название компани')->dropDownList(
        $dataForSelectCompanies,
        [
            'options' => [
                0 => ['selected' => 'true']
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сформировать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
