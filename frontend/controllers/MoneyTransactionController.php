<?php

namespace frontend\controllers;

use frontend\models\MoneyTransactionsCategory;
use Yii;
use frontend\models\MoneyTransaction;
use yii\data\ActiveDataProvider;
use yii\debug\panels\DumpPanel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MoneyTransactionController implements the CRUD actions for MoneyTransaction model.
 */
class MoneyTransactionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MoneyTransaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MoneyTransaction::find()->with('category'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MoneyTransaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MoneyTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MoneyTransaction();

        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $data['MoneyTransaction']['user_id'] = Yii::$app->user->id;
            $data['MoneyTransaction']['created_at'] = time();
            $data['MoneyTransaction']['updated_at'] = time();

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $dataForSelectTypes = $this->getDataForSelectTypes();
        $dataForSelectCategories = $this->getDataForSelectCategories();
        return $this->render('create', [
            'model' => $model,
            'dataForSelectTypes' => $dataForSelectTypes,
            'dataForSelectCategories' => $dataForSelectCategories
        ]);
    }

    /**
     * Updates an existing MoneyTransaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dataForSelectTypes = $this->getDataForSelectTypes();
        $dataForSelectCategories = $this->getDataForSelectCategories();

        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $data['MoneyTransaction']['user_id'] = Yii::$app->user->id;
            $data['MoneyTransaction']['updated_at'] = time();

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataForSelectTypes' => $dataForSelectTypes,
            'dataForSelectCategories' => $dataForSelectCategories
        ]);
    }

    /**
     * Deletes an existing MoneyTransaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MoneyTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MoneyTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MoneyTransaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function getDataForSelectTypes()
    {
        return [
            MoneyTransaction::$TYPE_REVENUE => 'Доход',
            MoneyTransaction::$TYPE_EXPENSE => 'Расход',
        ];
    }

    private function getDataForSelectCategories()
    {
        $data = MoneyTransactionsCategory::getCategoriesByUserId(Yii::$app->user->id);
        return ArrayHelper::map($data, 'id', 'title');
    }
}
