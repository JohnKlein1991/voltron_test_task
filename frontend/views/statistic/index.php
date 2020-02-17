<?php
/* @var $this yii\web\View */
/** @var $dataForGroupBySelect array */
/** @var $dataForSelectCategories array */
/** @var $dataForSelectCompanies array */
?>

<?php
$this->title = 'Отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'dataForGroupBySelect' => $dataForGroupBySelect,
    'dataForSelectCompanies' => $dataForSelectCompanies,
    'dataForSelectCategories' => $dataForSelectCategories,
]) ?>

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
    '@web/js/statistic/index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
