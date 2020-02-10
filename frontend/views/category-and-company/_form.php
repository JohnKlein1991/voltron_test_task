<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin([
        'id' => 'category-and-company_modal_form',
        'enableAjaxValidation' => true,
        'validationUrl' => 'validate',
    ]); ?>
    <?= $form->field($model, 'title')->label('Название')->textInput() ?>

    <?= Html::submitButton('Сохранить'); ?>
    <?php $form->end(); ?>

</div>
