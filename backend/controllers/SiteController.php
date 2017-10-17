<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\UploadFormExcel;	
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\models\Files;
use app\models\Templatelist;
use app\models\Dataexcel;
use common\models\OrgSearch;
use common\models\Typemat;
use common\models\Org;
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
                        'actions' => ['login', 'error', 'index', 'get'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'template', 'import','show','helpers','helperssave', 'delete'],
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

    

    //справочники
    public function actionHelpers($model = 'common\models\Typemat')
    {
       	$model = new $model();	    	
    	if (Yii::$app->request->isPost){
    		//получаем первый элемент 
    	//	$id = current(Yii::$app->request->post());
    		
    		//if (isset($id)) {
    	//		$model->findOne($id);
    	//	}
    		$post = Yii::$app->request->post();
    		
    		if ( isset($post[$model->formName()]))
    		{
    			//получаем первый элемент массива и подгружаем модель для сохранения
    			$modelSU = 	$model::findOne(current($post[$model->formName()]));
    			if (isset($modelSU)) {
    				//изменяем старую запись
    				$modelSU->load($post);
    				$modelSU->save();
    			}
    			else {
    				//сохраняем новый
    				$model->load($post);
    				$model->save();
    			}
    			
    		
    	
    		}
    	}
	
    		$dataProvider =  new ActiveDataProvider([
    				'query' =>  $model::find(),
    				'pagination' => [		
    						'pageSize' => 10,
    				],
    		]);
    		$classSearch = $model::className().'Search';
			if (class_exists($classSearch)) {
    		$searchModel = new $classSearch();
    		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			}
			else 
			{
				$searchModel = '';
			}
    	return $this->render('helpers', ['model' => $model, 'dataProvider' =>$dataProvider, 'searchModel' => $searchModel, 'id'=>Yii::$app->request->get('id')]);
 
    	
    }
    
   
    
    
    
    public function actionDelete($id, $model)
    {
    	$modeld = new $model();
    	$modeld::findOne($id)->delete();

   		return $this->redirect(['helpers','model'=>$model]);

    }
 
    /***/
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
    
    //выставялем данные в таблицу DataExcel
    public function actionImport()
    {
    
    
    	if (Yii::$app->request->isAjax){
    		$request = Yii::$app->request;
    		$post = $request->post();
    		$dt = new Dataexcel();
    		$dt->insertData($post['file'], $post['cheks'],$post['basefile'],$post['comment']);
    
    	}
    
    }
    
    //показываем файлы уже загруженные
    public function actionShow()
    {
    
    	if (Yii::$app->request->isPost){
    		$request = Yii::$app->request;
    		$post = $request->post();
    		$model = Dataexcel::find()->where(["id"=>$post["id"]])->one();
    		return $this->renderAjax("showf",["model"=>$model]);
    	}
    }
    
    public function actionFileload()
    {
    	$xlsx = new ExcelReader(Yii::$app->request->get());
    
    
    	return $xlsx->getResult();
    }
    
    //возвраещт счета и счетфактуры для шаблнов в сапе
    public function actionGet()
    {
    	 
    	$this->enableCsrfValidation = false;
    	
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
    
    
    
    /***/
    
    /**
     * 
     * 
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
     * Login action.
     *
     * @return string
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
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    public function actionTemplate()
    {
    
 
    	$dataProvider =  new ActiveDataProvider([
    			'query' =>  Files::find(),
    			'pagination' => [
    					'pageSize' => 10,
    			],
    	]);
    	 
    	//$templateList  = Templatelist::find()->select(['id', 'nametemplate'])->asArray()->all();
    	$model = new Templatelist();
    	 
    	return $this->render('template',['listDataProvider'=>$dataProvider,	'model'=>$model, 'keymodel'=> new Org]);
    }
}




