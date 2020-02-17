<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\MoneyTransactionsCategory;
use frontend\models\StatisticForm;
use Yii;
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
     * @return string
     */
    public function actionIndex()
    {
        $model = new StatisticForm();
        $dataForGroupBySelect = $this->getDataForGroupBySelect();
        $dataForSelectCategories = $this->getDataForSelectCategories();
        $dataForSelectCompanies = $this->getDataForSelectCompanies();

//        $dataProvider = new ActiveDataProvider([
//            'query' => MoneyTransaction::find()
//                ->with('category')
//                ->orderBy([
//                    'date' => SORT_DESC
//                ]),
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);

        return $this->render('index', [
            'model' => $model,
//            'dataProvider' => $dataProvider,
            'dataForGroupBySelect' => $dataForGroupBySelect,
            'dataForSelectCategories' => $dataForSelectCategories,
            'dataForSelectCompanies' => $dataForSelectCompanies
        ]);
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
        $data[0] = 'Все категории';
        return $data;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getDataForSelectCompanies()
    {
        $data = Company::getCompaniesByUserId(Yii::$app->user->id);
        $data = ArrayHelper::map($data, 'id', 'title');
        $data[0] = 'Все компании';
        return $data;
    }
}
