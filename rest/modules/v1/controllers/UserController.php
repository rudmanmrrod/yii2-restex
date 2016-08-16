<?php

namespace app\rest\modules\v1\controllers; 

use Yii;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\User;

class UserController extends ActiveController
{

	public $modelClass = 'app\models\User';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    
	public function actions()
	{
		$actions = parent::actions();
		
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

		// disable the "delete" and "create" actions
		unset($actions['delete'], $actions['create'], $actions['view']);

		return $actions;
	}
	
	public function prepareDataProvider()
	{
		return User::find()->select(['id','username','email'])->all();
		//	prepare	and	return	a	data	provider	for	the	"index"	action
	}
	
	public function actionCreate()
	{
		$signup = new SignupForm();
		$signup->setAttributes(Yii::$app->request->post());
		if($signup->validate())
		{
			$user = new User();
            $user->username = $signup->username;
            $user->email = $signup->email;
			$user->setPassword($signup->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->save();
            return $signup;
		}
		else
		{
			return $signup->getErrors();
		}
	}
	
	public function actionView($id)
	{
		if(User::findOne($id))
			return User::find($id)->select(['id','username','email','status','created_at','updated_at'])->one();
		else
			return "El usuario no existe";
	}
	
	
	public function actionLogin()
	{
		$login = new LoginForm();
		$login->setAttributes(Yii::$app->request->post());
		if($login->validate())
		{
			return "auth_key: ".$login->getUser()->auth_key;
		}
		else
		{
			return $login->getErrors();
		}
	}
}
