<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AuthAssignment;
use yii\rbac\Role;
use yii\web\ForbiddenHttpException;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can( 'create-user' )) {
            $model = new User();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
          // throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can( 'edit-user' )) {
            $model = $this->findModel($id);

            $auth = Yii::$app->authManager;
      
            $items = $model['role'];
           // echo $items;die;
            $item = $auth->getRole($items);
            
            if ($model->load(Yii::$app->request->post())) {

                $role = Yii::$app->request->post('User')['role'];
                
                if($items=='Guest'){
                    
                    $role2 = $auth->getRole($role);

                    $auth->assign($role2, $id);

                }else{

                    $auth->revoke($item, $id);
                 
                    $role2 = $auth->getRole($role);

                    $auth->assign($role2, $id);
                }

                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
         //  throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can( 'delete-user' )) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
           //throw new ForbiddenHttpException("You don't have permission to access this page.");
            return $this->render('/site/site', []);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
