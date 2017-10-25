<?php
use backend\component\ListTable;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\iRelation;
use backend\component\ListData;

//use frontend\models\Typesender;
?>

<?php  
 	
//пердаю выбранный класс (таблицу)

echo  ListTable::widget(['name'=>'table','items'=>ListData::getDatahelpers() ,'selected' => $model::className(), 'id'=>'helpDrop']);

?>
<div id="result"> </div>


<?php

use yii\grid\GridView;
use yii\widgets\Pjax;






$this->registerJS("$('document').ready( function () {
$('#new_helpers').on('pjax:end', function () {
	$.pjax.reload({container:'#view_helpers'});
}); });");




Pjax::begin(['id'=>'new_helpers']);



$form = ActiveForm::begin([
		'options' => ['id'=>'frmHelpers', 'data-pjax' => 'true']]);


$relation = [];
$keyModel = [];
$m=[];


if (is_object($model)){
		
    //записываем имя таблицы
	echo Html::hiddenInput('tablename', $model::tableName());
	//записываем имя модели
	echo Html::hiddenInput('table', $model::className());
	//скрыое поле с аттрибутами таблицы(модели)
	echo Html::hiddenInput('keymodel', json_encode($model->attributes));
	
	
	
	//$arr = $model->attributes;
	//поля модели
	$arr = $model->toArray();
	
	//значение пол
	//echo Html::hiddenInput('table',$model::className());
	
	//если модель реализует интерфейс то 
	if ($model instanceof  iRelation)
	{
		//связи полей
     	$relation  = $model::relation();
   		//$m =explode('.', '' );
  
	}
	
	
	//поле для выбора
	$keyModel['select']['class'] = 'yii\grid\ActionColumn';
	$keyModel['select']['template'] = '{select}';
	$keyModel['select']['buttons'] = [ 'select' => function ($url, $model) {
		return Html::a(
				'<span class="">Выбрать</span>',
				"#",['onClick'=>'fillForm(this)'] );}
		];
	}
	
	//убираем ключевое поле из полей
	//unset($arr[$model::primaryKey()[0]]);
	$primary = $model::primaryKey()[0];
	echo $form->field($model, $primary)->hiddenInput();
	
	foreach ($arr  as $key=>$value)
	{
			
	//	$dt = new DataColumn();
		//получаем поле ключем и записываем в скрытый объект
			
		
				//если есть связи с справочными таблицами
				if (isset($relation[$key]))
				{

					$keyModel[$key]['value'] = $relation[$key];
					
					$m =explode('.', $relation[$key] );
					
					$obj = "common\\models\\". $relation[$m[1].'Model'];
			
					$mmodel = new $obj;
					
					echo $form->field($model, $relation[$m[1].'Form'])->dropDownList($mmodel->getItems($id));
			 		
					
					
					break;
				}
			
				if ($primary!=$key)
				{
				echo $form->field($model,$key );
				}
		//заполняем массив для отображение полей в гриде
		$keyModel[$key]['attribute'] = $key;
		$keyModel[$key]['format'] = 'text';
		$keyModel[$key]['label'] = $key;
		
		}	
		
			
	
		
		
		
		

		
		
		
	

		//echo  implode($model->$key);
	
	
	
	//добавляем кнопку удаления в грид
	$keyModel['delete']['class'] = 'yii\grid\ActionColumn';
	$keyModel['delete']['template'] = '{delete}';
	$keyModel['delete']['buttons'] = [ 'delete' => function ($url,$model) {
		return Html::a(
				'<span class="glyphicon glyphicon-remove"></span>',
				$url.'&model='.$model->className(),['onClick'=>'return confirm("Подтвердите удаление")']);	},
	];

	//поля для связи с другимим спрвочниками
	if (isset($relation['Org']))
	{
	
		//добавляем 
		$keyModel['related']['class'] = 'yii\grid\ActionColumn';
		$keyModel['related']['template'] = '{helpers}';
		$keyModel['related']['buttons'] = [ 'helpers' => function ($url, $model) {
			return Html::a(
					'<span class="glyphicon glyphicon-magnet"></span>',
					//получаем ссылку на модель(таблицу) которая имеет отношение к данной модели
					$url.'&model='.$model::relation()[$model->formName()],['data-pjax'=>'0']);}
					];
	}
	

	
	
	
	echo  Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);



ActiveForm::end(); 



Pjax::end();


 
Pjax::begin(['id' => 'view_helpers']);
 echo  GridView::widget([
		'dataProvider' => $dataProvider,
 		'filterModel' => $searchModel,
 		//'rowOptions' => function ($model, $key, $index, $grid){
 						
 						// $js = 	json_encode(array_keys($model->toArray()));
 			//			return 	['id' =>'', 'style'=> 'cursor:pointer', 'onclick'=>'fillForm(this)'];
				//		 },
 		//$keyModel,
		'columns' =>    $keyModel 	,
				//['attribute'=>'nameMat',
			//	'format'=>'text',
		//		 'value'=>'nameMat',
			//	],
		/*		[ 
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-remove"></span>', 
                    $url);
                },
            ],
        ],*/
       ]);

 Pjax::end([]);
?>


