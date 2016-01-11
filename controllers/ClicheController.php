<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Cliche;
use app\models\Customers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClicheController implements the CRUD actions for Cliche model.
 */
class ClicheController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cliche models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cliche::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliche model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $selectedCustomer=$this->findModelCustomers($model->customerId);
        return $this->render('view', [
            'model' => $model,
            'selectedCustomer' => $selectedCustomer->customerName,
        ]);
    }

    /**
     * Creates a new Cliche model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliche();

        $customers_base = array();
        $customers_model = new Customers();
        $customers_model->scenario = 'clisheEdit';

        $good_base= $customers_model->find()
            ->where(['isWork' => 1])
            ->orderBy('id')
            ->asArray()
            ->all();
        foreach ($good_base as $key => $value) {
            $customers_base=array_combine(array($value["id"]), array($value["customerName"]));
        }
        

        //if (Model::loadMultiple([$model, $customers_model], Yii::$app->request->post())) {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'customers_model' => $customers_model,
                'customers_base' => $customers_base,
            ]);
        }
    }

    /**
     * Updates an existing Cliche model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $customers_base = array();
        $customers_model = $this->findModelCustomers($model->customerId);
        $customers_model->scenario = 'clisheEdit';

        $good_base= $customers_model->find()
            ->where(['isWork' => 1])
            ->orderBy('id')
            ->asArray()
            ->all();
        foreach ($good_base as $key => $value) {
            $customers_base=array_combine(array($value["id"]), array($value["customerName"]));
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'customers_model' => $customers_model,
                'customers_base' => $customers_base,
            ]);
        }
    }

    /**
     * Deletes an existing Cliche model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliche model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliche the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliche::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelCustomers($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
