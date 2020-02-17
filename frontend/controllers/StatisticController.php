<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\MoneyTransactionsCategory;
use frontend\models\StatisticForm;
use frontend\services\StatisticService;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class StatisticController
 * @package frontend\controllers
 */
class StatisticController extends \yii\web\Controller
{
    /**
     * @var StatisticService
     */
    private $service;

    /**
     * StatisticController constructor.
     * @param $id
     * @param $module
     * @param StatisticService $service
     * @param array $config
     */
    public function __construct($id, $module, StatisticService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array|string
     */
    public function actionIndex()
    {
        $model = new StatisticForm();
        $dataForGroupBySelect = $this->getDataForGroupBySelect();
        $dataForSelectCategories = $this->getDataForSelectCategories();
        $dataForSelectCompanies = $this->getDataForSelectCompanies();

        if (Yii::$app->request->isAjax && isset(Yii::$app->request->post()['StatisticForm'])) {
            $requestData = Yii::$app->request->post()['StatisticForm'];
            $data = $this->getDataForStatisticTable($requestData);

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => true,
                'data' => $data
            ];
        } else {
            $data = $this->getDataForStatisticTable();
            $dataProvider = new ArrayDataProvider([
                'allModels' => [$data],
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'dataForGroupBySelect' => $dataForGroupBySelect,
                'dataForSelectCategories' => $dataForSelectCategories,
                'dataForSelectCompanies' => $dataForSelectCompanies
            ]);
        }
    }

    /**
     * @return array
     */
    public function actionValidate()
    {
        $model = new StatisticForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model, [
                'date_from',
                'date_to',
                'group_by',
                'category_id',
                'company_id',
            ]);
        }
    }

    /**
     * @param array $requestData
     * @return mixed
     * @throws \yii\db\Exception
     */
    private function getDataForStatisticTable($requestData = [])
    {
        $userId = Yii::$app->user->id;
        return $this->service->getDataForStatisticTable($requestData, $userId);
    }

    /**
     * @return array
     */
    private function getDataForGroupBySelect()
    {
        return [
            StatisticForm::$GROUP_BY_DAYS_VALUE => 'По дням',
            StatisticForm::$GROUP_BY_MONTHS_VALUE => 'По месяцам'
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getDataForSelectCategories()
    {
        $userId = Yii::$app->user->id;
        $data = MoneyTransactionsCategory::getCategoriesByUserId($userId);
        $data = ArrayHelper::map($data, 'id', 'title');
        $data[StatisticForm::$ALL_CATEGORIES_VALUE] = StatisticForm::$ALL_CATEGORIES_TITLE;
        return $data;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getDataForSelectCompanies()
    {
        $data = Company::getCompaniesByUserId(Yii::$app->user->id);
        $data = ArrayHelper::map($data, 'id', 'title');
        $data[StatisticForm::$ALL_COMPANIES_VALUE] = StatisticForm::$ALL_COMPANIES_TITLE;
        return $data;
    }
}
