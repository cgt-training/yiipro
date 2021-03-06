<?php

namespace backend\controllers;

use Yii;
use app\models\Branch;
use app\models\BranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
//use yii\helpers\Html;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class BranchController extends Controller
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
     * Lists all Branch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branch model.
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
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {  // echo Yii::$app->user->can( 'create-branch' );exit();
        if (Yii::$app->user->can( 'create-branch' )) {
            $model = new Branch();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
         //  throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can( 'edit-branch' )) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
           // throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    public function actionLists($id)
    {
        $countBranches = Branch::find()
            ->where(['company_fk_id' => $id])
            ->count();
        // $countBranches=1;
        $branches = Branch::find()
            ->where(['company_fk_id' => $id])
            ->all();

        if($countBranches > 0)
        {
            foreach ($branches as $branch) {
                echo "<option value='".$branch->branch_id."'>".$branch->branch_name."</option>";
            }
        }else{
            echo "<option>---</option>";
        }
    }

    /**
     * Deletes an existing Branch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->can( 'delete-branch' )) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            return $this->render('/site/site', []);
        }
    }

    /**
     * Finds the Branch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}