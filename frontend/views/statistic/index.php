<?php
/* @var $this yii\web\View */
/** @var $dataForGroupBySelect array */
/** @var $dataForSelectCategories array */
/** @var $dataForSelectCompanies array */
/* @var $dataProvider yii\data\ArrayDataProvider */

?>

<?php
$this->title = 'Отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="alert_result_of_request" class="alert" role="alert" style="display:none;">
</div>

<?= $this->render('_form', [
    'model' => $model,
    'dataForGroupBySelect' => $dataForGroupBySelect,
    'dataForSelectCompanies' => $dataForSelectCompanies,
    'dataForSelectCategories' => $dataForSelectCategories,
]) ?>

<div id="statistic-table" style="display: none">
    <?=
    $this->render('statistic_table');
    ?>
</div>

<div id="alert_additional_info" class="alert alert-info" role="alert" style="display: none">
    По данным параметрам транзакции отсутствуют
</div>

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
