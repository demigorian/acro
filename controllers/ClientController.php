<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use app\models\Ctel;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller {

    public function behaviors() {
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
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Client();
        $modelsCtel = [new Ctel];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsCtel = Model::createMultiple(Ctel::classname());
            Model::loadMultiple($modelsCtel, Yii::$app->request->post());

            // ajax validation
             
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCtel) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCtel as $modelCtel) {

                            $modelCtel->id_client = $model->client_id;
                            if (!($flag = $modelCtel->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->client_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelsCtel' => (empty($modelsCtel)) ? [new Ctel] : $modelsCtel
            ]);
        }
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelsCtel = $model->ctels;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsCtel = Model::createMultiple(Ctel::classname());
            Model::loadMultiple($modelsCtel, Yii::$app->request->post());

            // ajax validation
             
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCtel) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCtel as $modelCtel) {

                            $modelCtel->id_client = $model->client_id;
                            if (!($flag = $modelCtel->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->client_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('udate', [
                        'model' => $model,
                        'modelsCtel' => (empty($modelsCtel)) ? [new Ctel] : $modelsCtel
            ]);
        }
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
