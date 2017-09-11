
<?php 

	use yii\widgets\ListView;

	

?>





<!-- <div id="searorg"> -->



<?php  //yii\widgets\Pjax::begin(['id'=>'searorg' ,'enablePushState' => false])?>
<div class="regisin-form">



        
</div>


<div>

    <?= ListView::widget([
        'dataProvider'=>$dataProviderlst ,    
    	'itemView'=> function ($model, $key, $index, $widget){
    				$content =$this->render('item_view',['model'=>$model]);
    				return $content;
    		}
   			 
    ]); ?>
    
    <?php  //yii\widgets\Pjax::end(); ?>

    
</div>




