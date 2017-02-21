<?php

namespace backend\controllers;

use Yii;
use backend\models\Po;
use backend\models\PoSearch;
use backend\models\PoItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use app\base\Model;
use backend\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function init()
    {
        if(!Yii::$app->user->identity)
        {
            $this->redirect(array('/site/login'));
        }
    }

    /**
     * Lists all Po models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Po model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        if (Yii::$app->user->can( 'create-po' )) {
            $model = new Po();
            $modelsPoitem = [new PoItem];
          
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $modelsPoitem = Model::createMultiple(PoItem::classname());
                Model::loadMultiple($modelsPoitem, Yii::$app->request->post());

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsPoitem) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsPoitem as $modelPoitem) 
                            {
                                 $modelPoitem->po_id = $model->id;

                                if (! ($flag = $modelPoitem->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modelsPoitem' => (empty($modelsPoitem)) ? [new PoItem] : $modelsPoitem,
                ]);
            }
        }else{
          // throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    /**
     * Updates an existing Po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can( 'edit-po' )) {
            $model = $this->findModel($id);
            $modelsPoitem = [new PoItem];

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                 $modelsPoitem = Model::createMultiple(PoItem::classname());
                Model::loadMultiple($modelsPoitem, Yii::$app->request->post());

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsPoitem) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsPoitem as $modelPoitem) 
                            {
                                 $modelPoitem->po_id = $model->id;

                                if (! ($flag = $modelPoitem->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
               // return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                      'modelsPoitem' => (empty($modelsPoitem)) ? [new PoItem] : $modelsPoitem,
                ]);
            }
        }else{
          // throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }  
    }

    /**
     * Deletes an existing Po model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can( 'delete-po' )) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
         }else{
           //throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        } 
    }

    /**
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
