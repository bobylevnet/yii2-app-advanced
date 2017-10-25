<?php
namespace frontend\controllers;

use common\models\Reguser;

class UserController extends \yii\web\Controller
{
    public function actionJsuser()
    {
    	
    	
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	//\yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
    	$jsOrg = Reguser::find()->select(['idUser','nameUser'])->where(['idOrg'=>\Yii::$app->request->queryParams['idOrg']])->all();
    	//$items = \yii\helpers\ArrayHelper::map(Typemat::find()->all(),'idMatDoc','nameMat');
    	
    	return $jsOrg;
    }

}
