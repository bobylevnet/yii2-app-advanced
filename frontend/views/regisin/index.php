<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regisins';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="regisin-create">

    
		
    
    <?php 
    $this->registerJsFile('@web/js/_pjax.js', ['depends'=>'yii\web\JqueryAsset']);
    
    $this->registerJs("$('document').ready( function() {
      $('#new_row').on('pjax:end', function () {
       $.pjax.reload({container: '#grid'});
       });
    });");
    
    // $this->registerJs("$('document').ready( function() {
     // $('#searorg').on('pjax:end', function () {
     //  $.pjax.reload({container: '#list'});
    //   });
   // });");
     
    ?>
    
    
    
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::input('text','find', '' ,['id'=>'find']); ?>
    
    <div id="searorg">
    </div>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


<div class="regisin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Regisin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php     \yii\widgets\Pjax::begin(['id'=>'grid'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'filterModel'=> $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRin',
           
            [ 'attribute'=>'idOrg',
                'format'=>'text',
                'filter'=>array("1"=>"open","2"=>"close")
             ],
        	[ 'attribute'=>'nameTypeDoc',
        		'format'=>'text',
        	   'value' => 'typed.nameTypeDoc',
        			
        			
        			
   			 ],
        	[ 'attribute'=>'nameMat',
        		 
        	'value' => 'typem.nameMat',
            ],
            'idTypDocum',
            'aboutDoc',
            // 'dateDoc',
            // 'yearDoc',
            // 'idUserRun',
            // 'idUserOrg',
            // 'listNumber',
            // 'countList',
            // 'dateIn',
            // 'numberIn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end()?>
</div>
