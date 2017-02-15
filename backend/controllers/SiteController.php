<?php
namespace backend\controllers;

use Yii;
use app\models\Branch;
use app\models\BranchSearch;
use app\models\Company;
use app\models\CompanySearch;
use app\models\Department;
use app\models\DepartmentSearch;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       // return $this->render('index');

        $branchModel = new BranchSearch();
        $brachCount = $branchModel->count();
        $companyModel = new CompanySearch();
        $companyCount = $companyModel->count();
        $departmentModel = new DepartmentSearch();
        $departmentCount = $departmentModel->count();
        $userModel = new UserSearch();
        $userCount = $userModel->count();

        return $this->render('index', [
          'brachCount' => $brachCount,
          'companyCount' => $companyCount,
          'departmentCount' => $departmentCount,
          'userCount' => $userCount,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'LoginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
