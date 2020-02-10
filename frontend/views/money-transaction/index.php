<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\MoneyTransaction;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $dataForSelectTypes array */
/** @var $dataForSelectCategories array */
/** @var $dataForSelectCompanies array */
/* @var $model frontend\models\MoneyTransaction */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="alert" id="result_of_creating" role="alert" style="display: none">
    <span></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'create_transaction_form',
    'action' => '/money-transaction/create',
    'enableAjaxValidation' => true,
    'validationUrl' => '/money-transaction/validate',
]); ?>
<?= $form->field($model, 'amount')->label('Сумма')->textInput() ?>
<?= $form->field($model, 'category_id')->label('Название категории')->dropDownList($dataForSelectCategories) ?>
<?= $form->field($model, 'company_id')->label('Название компании')->dropDownList($dataForSelectCompanies) ?>
<?= $form->field($model, 'type')->label('Тип')->radioList($dataForSelectTypes) ?>
<?= $form->field($model, 'date')->label('Дата')->textInput(['id' => 'datepicker']) ?>
<?= Html::submitButton('Сохранить'); ?>
<?php $form->end(); ?>

<div class="money-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить транзакцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'date',
                'label' => 'Дата'
            ],
            [
                'attribute' => 'Категория',
                'value' => 'category.title'
            ],
            [
                'attribute' => 'Компания',
                'value' => 'company.title'
            ],
            [
                'attribute' => 'amount',
                'label' => 'Сумма'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

    <?php
    $this->registerCssFile(
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ['depends' => [\yii\web\JqueryAsset::class]]
    );
    $this->registerJsFile(
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        ['depends' => [\yii\web\JqueryAsset::class]]
    );
    $this->registerJsFile(
        '@web/js/money-transactions/index.js',
        ['depends' => [\yii\web\JqueryAsset::class]]
    );

    ?>
</div>
