<?php

/* @var $this yii\web\View */

use backend\component\ListData;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use backend\models\Templatelist;
use yii\jui\Draggable;
use yii\jui\Droppable;
use backend\component\ListTable;

$this->title = 'Источники';
$this->params['breadcrumbs'][] = $this->title;


$this->registerJs('$(".btn-submit").click( function () {	
						
					function fnc(data) {
					$(".load").html(data);
					}
		
		
					var elementsDrop = $(this).parent().find(".drop");
						
						var arr = {};
						
	                	for(var i=0; elementsDrop.length>i; i++)
						{
							var value = $(elementsDrop[i]).find("input[type=\'hidden\']").val();
							var key = 	$(elementsDrop[i]).find("input[type=\'hidden\']").attr("name");
							arr[key] = value;	 
						}
							arr["model"]=  $("#templatelist-nametemplate").val();
		
							if( $("#import").val()==1)
							{
								arr["import"]= $("#import").attr("name");
							}
							else
							{
								arr["import"]="";
							}
		
					ajx("importtemplate",arr,fnc);
					})');

$this->registerJs('$("#templatelist-nametemplate").change(function () {
					changeParameters(this.value);	
})')


?>



<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>



</div>

<div class="row">
 
    <div class="col-lg-3">   
    <?php

echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => function ($modelList, $key, $index, $widget) {
        return $this->render('_files',['model' => $modelList, 'key' => $key]);
},
]);



?>
    </div>
    

 <div class="col-lg-4 back"> 





<?php



$form = ActiveForm::begin(['id'=>'frm-import']);

    $params = [	
        'prompt' => 'Выберите шаблон'
    ];
    
    echo  ListTable::widget(['name'=>'table','items'=>ListData::getDataTemplate() ,'selected' => $model::className(), 'id'=>'templatelist-nametemplate']);
    
     
        
        
        Droppable::begin([
        		 
        		'clientOptions' => ['grid' => [50, 20]],
        		'id' => 'dropElement',
        		
        		"clientEvents" => [
        				 
        				"drop" =>
        				"function (event, ui) {
        				
        				var elemeDrop = $(this).find('.column-insert');
        				var objDrop = ui.draggable;
        				//получаем id родителя перетаскиваемого элемента для того чтоб потом правильно удалить его
        				var parentId = $(objDrop).parent().attr('id');
        				//получаем id элемента для добавления в drop элемент
        				var id = $(objDrop).attr('id');
        				//сбрасываем положение элемента
        				$(objDrop).css({'top' : '0px', 'left' : '30px'});
        				//проверяем есть ли данный элемент дабы не добавлять его два раза
        				if ($('.append #'+id).length==0)
        				{  
        				//добавляем элемент 
        				$(this).find('.append').append(objDrop);
        				//добавляем ссылку удалить 
        				$(this).find('.append #'+id).find('.drop').append('<a class=\"'+id+'\" href=# onClick=\'resetCss(\"'+id+'\",\"' + parentId + '\")\'> Удалить</a>');
        			
        				
        				}
        				

        		}",
        				"out" =>  "function (event, ui)
        		{
        	  
       
      			}",
        				 
        		"out" => "function (event, ui) {
        	     var elemeDrop = $(this).find('.column-insert');
      					$(ui.draggable).css({'top' : '0px', 'left' : '0px'});
       
       					 	}",
        			 
        	   "activate" => "function (event, ui){
      
      
        					 }",
        	   "deactivate" => "function (event, ui){
        
      
        					 }",
        				 
        		],
        		 
        ]);
        
      	echo Html::tag('div','',['class' => 'append']);
         
        Droppable::end();
        echo Html::label('',null, ['class'=>'load']);
        echo Html::button('Начать импорт', ['class' => 'btn btn-success btn-submit' ] );
         
        ActiveForm::end();
       ?> 
</div>
	<div class="col-lg-3">
        <div class="order">
        <h4>Порядок элементов для заполнение полей таблицы </h4>
        <?php 
        $arr= $keymodel->attributes;
        $labels = $keymodel->attributeLabels();
    	$i=0;
        foreach ($arr as $key=>$value)
        {
        	
        	echo Html::tag('div', $i . " " . $labels[$key],['class'=>'column']);
        	
        	$i=$i+1;

        }
        ?>
        
        <?php 
        $related = $keymodel->relation();
        

        echo  '<h4> 	Внешние </h4>';
			if (isset($related['import']))
			{
				echo Html::beginTag('div',['id'=>'related']);
        		echo Html::checkbox($related['import'],false,['id'=>'import' ,'label'=>$related['import']]);
        		echo '</br>';      
     	 	    echo Html::endTag('div');
			}
   
?>
</div>
 </div>
</div>
    

