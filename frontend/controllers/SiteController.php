<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Application;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\UploadFormExcel;
use frontend\models\ExcelModel;
use yii\web\UploadedFile;
use frontend\component\bobyii2excel\ExcelReader;
use yii\data\ActiveDataProvider;
use app\models\Files;
use app\models\Dataexcel;
use app\models\Templatelist;



/**
 * Site controller
 */
class SiteController extends Controller
{
    
//убираем проеврку токена
    public function init()
    {         
     parent::init();
     \yii::$app->request->enableCsrfValidation =false;


    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    { 	
    	$model = new UploadFormExcel();
    	if (Yii::$app->request->isPost){
    	
    		$model->excelFiles = UploadedFile::getInstances($model, 'excelFiles');	

    		if ($model->validate()){

                     $model->upload();
                       return $this->render ('index',  ['model'=> $model]);
                       
    		}	
    	} 	
    	
        return $this->render('index', ['model'=> $model]);
    }
    
    
    public function actionImport()
    {
            
        
        if (Yii::$app->request->isAjax){
            $request = Yii::$app->request;
           $post = $request->post();
           $dt = new \app\models\Dataexcel();
           $dt->insertData($post['file'], $post['cheks'],$post['basefile'],$post['comment']);
            
        }
        
    }
    
    
    public function actionShow()
    {
        
        if (Yii::$app->request->isPost){
             $request = Yii::$app->request;
           $post = $request->post();
           $model = Dataexcel::find()->where(["id"=>$post["id"]])->one();
        
        return $this->renderPartial("showf",["model"=>$model]);
    }
    }
    
    public function actionFileload()
    {
        $xlsx = new ExcelReader(Yii::$app->request->get());
        
        
        return $xlsx->getResult();
    }


    public function actionGet()
    {
        //отключаем проверку токена
    
        $idBills=0;
        $idBillsf=0;
   //if (Yii::$app->request->isPost){
          $request = Yii::$app->request;
           $post = $request->post();
         
           
          //получаем что id счетов и счет фактур
           $model = Files::find()->select(["id"])->where(["comment"=>"счета"])->asArray()->all();
           $modelf = Files::find()->select(["id"])->where(["comment"=>"фактуры"])->asArray()->all();
         
           if (!empty($model))
           {
              $idBills =  $model[0]["id"];
           }
            if (!empty($modelf))
           {
           $idBillsf =  $modelf[0]["id"];
           }
          $kks =  trim($post["kks"]);
          
           
           $rBills = Dataexcel::find()->select(["column2",  "column3"])->where(["column1"=>$kks,"id"=>$idBills])->asArray()->all();
           $rBillsf = Dataexcel::find()->select(["column2",  "column3"])->where(["column1"=>$kks,"id"=>$idBillsf])->asArray()->all();
           
          \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
          $str =  $this->arrstr($rBills);
          $strf = $this->arrstr($rBillsf);
        
           return $strf . "&" . $str  ;
           
           
   //}
     
    }
    
    
    function arrstr($arr)
    {
        $str="";
        foreach ($arr as $ar)
        {
           foreach ($ar as $key=>$value)
           {
             
               $str = $str. $ar[(string)$key] . ";";
           }

        }
         return $str;
    }


        /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionTemplate()
    {
      
       $dataProvider =  new ActiveDataProvider([
            'query' =>  Files::find(),
              'pagination' => [
                'pageSize' => 10,
            ],
        ]);
       
       $templateList  = Templatelist::find()->select(['id', 'nametemplate'])->asArray()->all();
       $model = new Templatelist();
       
        return $this->render('template',['listDataProvider'=>$dataProvider,'templateList'=>$templateList,'model'=>$model]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
