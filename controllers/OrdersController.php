<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderDetail;
use app\models\OrderDetailPressure;
use app\models\Customers;
use app\models\User;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/**
 * OrdersController implements the CRUD actions for Order model.
 */
class OrdersController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $modelItemsProvider=$this->getModelItemsProvider($model->orderId);
        $modelCustomer=$this->findModelCustomers($model->customerId);
        $modelManager=$this->findModelUsers($model->managerId);
        $modelBugalter= $this->findModelUsers($model->bugalterId);
        $modelTypographer= $this->findModelUsers($model->typographerId);


        
        
        

        return $this->render('view', [
            'model' => $model,
            'modelItemsProvider' => $modelItemsProvider,
            'manager' =>(($modelManager==0)?0:$modelManager->displayName),
            'customer' =>(($modelCustomer==0)?0:$modelCustomer->customerName),
            'bugalter' =>(($modelBugalter==0)?0:$modelBugalter->displayName),
            'typographer'=>(($modelTypographer==0)?0:$modelTypographer->displayName),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $modelItems = [new OrderDetail];
        $customers_model = new Customers();
        $modelUser= new User();
        $model->scenario = 'managerAdd';

        $good_base= $customers_model->find()
            ->where(['isWork' => 1])
            ->orderBy('id')
            ->asArray()
            ->all();

        $customers_base=$arr_keys=$arr_vals=array();
        foreach ($good_base as $key => $value) {
            
            array_push($arr_keys, $value["id"]);
            array_push($arr_vals, $value["customerName"]);
            
        }
            $customers_base=array_combine(array($arr_keys), array($arr_vals));


        if ($model->load(Yii::$app->request->post())) {

            $modelItems = OrderDetail::createMultiple(OrderDetail::classname());
            // $modelItems = Model::createMultiple(OrderDetail::classname());
            Model::loadMultiple($modelItems, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelItems),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            echo "==model valid  ".$valid."  <br/>";
            $valid = print_r(Model::validateMultiple($modelItems)) && $valid;
            echo "==model items valid  ".print_r(Model::validateMultiple($modelItems))."  <br/>";
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                echo "==(trasaction) start<br/>";
                try {
                    if ($flag = $model->save(false)) {
                        echo "==(trasaction) model saved<br/>";
                        foreach ($modelItems as $modelItem) {
                            echo "==(trasaction) item saved<br/>";
                            $modelItem->orderId = $model->orderId;
                            if (! ($flag = $modelItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        echo "==(trasaction) commit<br/>";
                        return $this->redirect(['view', 'id' => $model->orderId]);
                        echo "==(trasaction) start redirect<br/>";
                    }
                } catch (Exception $e) {
                    echo "==(trasaction) rollback and exception<br/>";
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelItems' => (empty($modelItems)) ? [new OrderDetail] : $modelItems,
            'customers_base' => $customers_base,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelOrder = $this->findModel($id);
        $modelsItems = $this->getModelItems($modelOrder->orderId);
        $modelOrder->scenario = 'managerAdd';
        //$modelsItems = $modelOrder->items;
        $customers_model = new Customers();
        $customers_base=$arr_keys=$arr_vals=array();
        $good_base= $customers_model->find()
            ->where(['isWork' => 1])
            ->orderBy('id')
            ->asArray()
            ->all();
        foreach ($good_base as $key => $value) {
            
            array_push($arr_keys, $value["id"]);
            array_push($arr_vals, $value["customerName"]);
            
        }
            $customers_base=array_combine(array($arr_keys), array($arr_vals));


        if ($modelOrder->load(Yii::$app->request->post())) {
            echo "== post request<br/>";
            $oldIDs = ArrayHelper::map($modelsItems, 'id', 'orderId');
            echo "== oldIDs are=<br/>";
            print_r($oldIDs);
            $modelsItems = OrderDetail::createMultiple(OrderDetail::classname(), $modelsItems);
            Model::loadMultiple($modelsItems, Yii::$app->request->post());
            echo "== deletedIDs are=<br/>";
            print_r($deletedIDs);
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItems, 'id', 'orderId')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsItems),
                    ActiveForm::validate($modelOrder)
                );
            }

            // validate all models
            $valid = $modelOrder->validate();
            $valid = print_r(Model::validateMultiple($modelsItems)) && $valid;
            echo "== valid is=  ".$valid."<br/>";
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                echo "==(trasaction) start<br/>";
                try {
                    if ($flag = $modelOrder->save(false)) {
                        if (! empty($deletedIDs)) {
                            echo "==(trasaction) delete oldIDs<br/>";
                            OrderDetail::deleteAll(['orderId' => $deletedIDs]);
                        }
                        echo "==(trasaction) modelItems post data are=<br/>";                        
                        foreach ($modelsItems as $modelItems) {
                            echo "==(trasaction) save model item<br/>";
                            $modelItems->orderId = $modelOrder->orderId;
                            if (! ($flag = $modelItems->save(false))) {
                                echo "======(trasaction) rollback<br/>";
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        echo "==(trasaction) all ok. start redirect<br/>";
                        return $this->redirect(['view', 'orderId' => $modelOrder->orderId]);
                    }
                } catch (Exception $e) {
                    echo "======(trasaction) rollback catch way<br/>";
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelOrder' => $modelOrder,
            'modelsItems' => (empty($modelsItems)) ? [new OrderDetail()] : $modelsItems,
            'customers_base' => $customers_base
        ]);
    }

    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBugalterconfirm($id)
    {
        $modelOrder=$this->findModel($id);
        $modelOrder->scenario="bugalterConfirm";
        $values = [
            'bugalterId' => Yii::$app->user->identity->id,
            'orderStatus' => 'bugalter confirm',
        ];
        $modelOrder->attributes = $values;
        
        if ($modelOrder->save(false)) {            
            return $this->redirect(['index']);
        }else{
            echo "false";
        }

    }





    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
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
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelUsers($id)
    {
        if ($id==0) {
            return 0;
        }
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the OrderDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model or array of models
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function getModelItemsProvider($id)
    {
        
        
        
        if (($dataProvider = new ActiveDataProvider(['query' => OrderDetail::find()->where(['orderId' => $id])])) !== null) {
            return $dataProvider;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function getModelItems($id)
    {
        $model = OrderDetail::find()->where(['orderId' => $id])->all();
        return $model;
        /*if (($model = OrderDetail::find()->where(['orderId' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }*/
    }
}



