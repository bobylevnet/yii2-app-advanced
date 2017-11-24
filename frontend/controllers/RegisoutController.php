<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Regisout;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\RegisoutSearch;
use frontend\models\MaxNumber;
use common\models\Org;
/**
 * RegisoutController implements the CRUD actions for regisout model.
 */
class RegisoutController extends Controller
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

    /**
     * Lists all regisout models.
     * @return mixed
     */
    public function actionIndex()
    {
    	   	
    	$model = new Regisout();    

    	
    	if (Yii::$app->request->isPost)
    	{
    	$post = Yii::$app->request->post();
    	$model->load($post);

 		   //возвращаем следующий регистрационный номер
 		   $model->numberDoc = MaxNumber::getMax($model,2);
 		   $model->yearDoc = date('Y');
 		   
 		   //тип доставки устанавливаем как у организации
 	
 		   $model->save();
 		
    	}
        $searchModel = new RegisoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'model' => $model,
             'org'=> Org::getNameOrg($model['idOrg']),
        ]);
    }
    //регистрация из шаблона SAP
    public function actionRegsap()
    {
    	$model = new Regisout();
    	$post = Yii::$app->request->post();
    	if (isset($post['registerAuto']) && yii::$app->request->isPost){
    		//загружаем модель если она из сапа
   
    		
    		$model->setAttributes($post);
    		$model->numberDoc = MaxNumber::getMax($model,2);
    		$model->yearDoc = date('Y');
    		
    		if ($model['idTypeSender']=='0')
    		{
    			$model['idTypeSender']= Org::findOne(['idOrg'=>$model['idOrg']])['deilevery'];
    		}
    		
    		
    	    if ($model->save())
    	    {
    	    //сохраняем номер исходящего документа если модель сохранилась
    	    
    	    	MaxNumber::save();
    		return $model->numberDoc;
    	    }
    	    else 
    	    {
    	    	
    	    	return 'error';
    	    }
    		
    	
    	}
    	
    }

    /**
     * Displays a single regisout model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new regisout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new regisout();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRout]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing regisout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRout]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'org'=> Org::getNameOrg($model['idOrg']),
           
            ]);
        }
    }

    /**
     * Deletes an existing regisout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the regisout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return regisout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = regisout::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
