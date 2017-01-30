<?php
namespace frontend\models;
use yii;
use app\models\AuthAssignment;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $permissions;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
       // return $user->save(false) ? $user : null;
       // echo '<pre>';echo $user->id;exit();
        // //lets add the permission
        $permissionLists =$_POST['SignupForm']['permissions'];
        foreach ($permissionLists as $value) {
            $newPermission = new AuthAssignment;
            $auth = Yii::$app->authManager;
            $admin = $auth->createRole('admin');
            $newPermission->user_id = $user->id;
            $newPermission->item_name = $value;
            $auth->assign($admin, $user->id);
            //$newPermission->save();
        }
        return $user;
    }
}
