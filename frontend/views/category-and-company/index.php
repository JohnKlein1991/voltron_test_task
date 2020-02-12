<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $companiesDataProvider yii\data\ActiveDataProvider */
/* @var $categoriesDataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании и категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="company-and-category-index">

    <div class="alert" id="result_of_company_creating" role="alert" style="display: none">
        <span></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <h2>Компании</h2>

    <?= Html::button('Создать новую компанию', ['value' => Url::to(['category-and-company/create-company']), 'title' => 'Создание новой компании', 'class' => 'showModalButton btn btn-success']); ?>

    <?php \yii\widgets\Pjax::begin(['id' => 'pjax_company-list']); ?>
    <?= GridView::widget([
        'dataProvider' => $companiesDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Дата изменения',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons' => [
                    'update' => function($url,$model,$key){
                        $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>",[
                            'value'=> Url::to(["category-and-company/update-company/?id={$key}"]),
                            'class'=>'update-modal-click showModalButton grid-action',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Редактировать компанию'
                        ]);
                        return $btn;
                    },
                    'delete' => function ($url, $model, $key) {
                        $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>",[
                            'title'=> 'Удалить компанию',
                            'aria-label' => 'Удалить компанию',
                            'onclick' => "
                                if (confirm('Действительно хотите удалить компанию?')) {
                                    $.ajax('/category-and-company/delete-company/?id={$key}', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#pjax_company-list'});
                                    });
                                }
                                return false;
                            ",
                        ]);
                        return $btn;
                    },
                ]
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

    <?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'category-and-company_modal',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
        'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
    ]);
    echo "<div id='modalContent'><div style='text-align:center'><img src='/images/ajax-loader.gif'></div></div>";
    Modal::end();
    ?>

    <h2>Категории</h2>

    <?= Html::button('Создать новую категорию', ['value' => Url::to(['category-and-company/create-category']), 'title' => 'Создание новой категории', 'class' => 'showModalButton btn btn-success']); ?>

    <?php \yii\widgets\Pjax::begin(['id' => 'pjax_category-list']); ?>
    <?= GridView::widget([
        'dataProvider' => $categoriesDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            ['attribute' => 'created_at', 'format' => ['date', 'php:Y-m-d H:i:s']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:Y-m-d H:i:s']],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons' => [
                    'update' => function($url,$model,$key){
                        $btn = Html::button("<span class='glyphicon glyphicon-pencil'></span>",[
                            'value'=> Url::to(["category-and-company/update-category/?id={$key}"]),
                            'class'=>'update-modal-click showModalButton grid-action',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Редактировать категорию'
                        ]);
                        return $btn;
                    },
                    'delete' => function ($url, $model, $key) {
                        $btn = Html::button("<span class='glyphicon glyphicon-trash'></span>",[
                            'title'=> 'Удалить категорию',
                            'aria-label' => 'Удалить категорию',
                            'onclick' => "
                                if (confirm('Действительно хотите удалить категорию?')) {
                                    $.ajax('/category-and-company/delete-category/?id={$key}', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#pjax_category-list'});
                                    });
                                }
                                return false;
                            ",
                        ]);
                        return $btn;
                    },
                ]
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
$this->registerJsFile(
    '@web/js/company-and-category/index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);


