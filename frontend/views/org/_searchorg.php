
<?php 

	use yii\widgets\ListView;

	//$this->registerjs()

?>


<?php $this->registerJs('$(".item-list").mouseover(function ()
	{
		
		//alert("event");
		$(this).css("background-color", "gray");
	});
	$(".item-list").mouseleave(function ()
		{
				$(this).css("background-color", "white");
		});
		
		
		');
?>


<!-- <div id="searorg"> -->



<?php  //yii\widgets\Pjax::begin(['id'=>'searorg' ,'enablePushState' => false])?>




        
<div class="menu-find">


<?php $dataProviderlst->pagination= false;?>

    <?= ListView::widget([
        'dataProvider'=>$dataProviderlst ,    
    	'pager' =>[],
    	'itemView'=> function ($model, $key, $index, $widget){
    				$content =$this->render('item_view',['model'=>$model]);
    				return $content;
    		}
   			 
    ]); ?>
    
    <?php  //yii\widgets\Pjax::end(); ?>

    
</div>




