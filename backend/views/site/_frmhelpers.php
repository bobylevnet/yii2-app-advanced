<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;





$this->registerJS("$('document').ready( function () {
$('#new_helpers').on('pjax:end', function () {
	$.pjax.reload({container:'#view_helpers'});
}); });");




Pjax::begin(['id'=>'new_helpers']);
//'action' => ['site/helperssave']
$form = ActiveForm::begin([
		'options' => ['data-pjax' => 'true']]);

$keyModel = [];
if (is_object($model)){
		
     //записываем имя модели 
	echo Html::hiddenInput('table',$model::className());
		
	foreach ($model->attributes  as $key=>$value)
	{
	
		if  ($key === $model::primaryKey()[0]) {
			echo $form->field($model, $key)->hiddenInput();
		}
		else  {
		echo $form->field($model, $key);
		
		//сохраняем поля для отображения
		$keyModel[] = $key;
		}
		
		//echo $value;

		//echo  implode($model->$key);
	}
		
	echo  Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
}



ActiveForm::end(); 



Pjax::end();


Pjax::begin(['id' => 'view_helpers']);
 echo  GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [ implode($keyModel, ', '),
		     [ 
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-screenshot"></span>', 
                    $url);
                },
                
            ],
        ], ],
]) ;

 Pjax::end();
?>


