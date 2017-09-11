<?php

namespace frontend\controllers;

use Yii;
use app\models\regisin;
use app\models\RegisinSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * RegisinController implements the CRUD actions for regisin model.
 */
class RegisinController extends Controller
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
     * Lists all regisin models.
     * @return mixed
     */
    public function actionIndex()
    {
       $model = new \app\models\Regisin();
       
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           //получаем текущий год сохряняем
       	   $model->yearDoc = date('Y');
           $model = new \app\models\Regisin();
        };
        
      //  $org= new \app\models\OrgSearch();
       // $dataProviderlst = $org->search(Yii::$app->request->queryParams);
 		$searchModel = new RegisinSearch();
    	$dataProvider  = $searchModel->search (Yii::$app->request->queryParams);
     
        return $this->render('index', [
            'searchModel'=>$searchModel,
            'dataProvider' =>$dataProvider,
            'model'=>$model,
          //  'org'=>$org,
        //    'dataProviderlst'=>$dataProviderlst,
        ]);
    }

    /**
     * Displays a single regisin model.
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
     * Creates a new regisin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    
   


    public function actionCreate()
    {
        if (Yii::$app->request->getIsPjax())
        {
            $searchModel = new \app\models\OrgSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('create', [
            'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
            
        }
        
        $model = new regisin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRin]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing regisin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRin]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing regisin model.
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
     * Finds the regisin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return regisin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = regisin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
