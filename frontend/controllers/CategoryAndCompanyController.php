<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\ModalForm;
use frontend\models\MoneyTransactionsCategory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CategoryAndCompanyController implements the CRUD actions for Company model.
 */
class CategoryAndCompanyController extends Controller
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
                        'actions' => [
                            'index',
                            'create-company',
                            'update-company',
                            'validate',
                            'delete-company'
                        ],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $companiesDataProvider = new ActiveDataProvider([
            'query' => Company::find()
                ->where("owner_id = " . Yii::$app->user->id)
                ->orderBy([
                    'created_at' => SORT_DESC
                ]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $categoriesDataProvider = new ActiveDataProvider([
            'query' => MoneyTransactionsCategory::find()
                ->where("user_id = " . Yii::$app->user->id)
                ->orderBy([
                    'created_at' => SORT_DESC
                ]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'companiesDataProvider' => $companiesDataProvider,
            'categoriesDataProvider' => $categoriesDataProvider,
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $data['Company']['owner_id'] = Yii::$app->user->id;
            $data['Company']['created_at'] = time();
            $data['Company']['updated_at'] = time();

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateCompany($id)
    {
        $model = Company::findOne($id);

        if (isset(Yii::$app->request->post('Company')['title'])) {
            $model->title = Yii::$app->request->post('Company')['title'];
            $model->updated_at = time();
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return [
                    'success' => true,
                    'id' => $model->id
                ];
            } else {
                return $model->errors;
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        }
    }

    public function actionDeleteCompany($id)
    {
        $model = Company::findOne($id);

        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->delete()) {
            return [
                'success' => true,
                'id' => $model->id
            ];
        } else {
            return $model->errors;
        }
    }

    public function actionCreateCompany()
    {
        $model = new Company();

        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $data['Company']['owner_id'] = Yii::$app->user->id;
            $data['Company']['created_at'] = time();
            $data['Company']['updated_at'] = time();

            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load($data) && $model->save()) {
                return [
                    'success' => true,
                    'id' => $model->id
                ];
            } else {
                return $model->errors;
            }
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        }
    }

    public function actionValidate()
    {
        $model = new ModalForm();
        $request = Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}
