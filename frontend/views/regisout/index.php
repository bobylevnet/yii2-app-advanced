<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\MaxNumber;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Regisout */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Исходящие док.';
$this->params['breadcrumbs'][] = $this->title;
?>

     
     
     



 <?= $this->render('@app/views/findOrg')?>
 
    <?= $this->render('_form', [
        'model' => $model,
    	'org' => $org,
    ]) ?>

    



<div class="regisout-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Regisout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      <?php     \yii\widgets\Pjax::begin(['id'=>'grid'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'numberDoc',
        	'dateDoc',	
        	[ 'attribute'=>'nameOrg',
        		'format'=>'text',
        		'value'=>'org.nameOrg'
        	],
          
        	[ 'attribute'=>'nameMat',     		 
        	'value' => 'typem.nameMat',
            ],
            'aboutDoc',
            'dateDoc',
         
        	[ 'attribute' => 'userNameOrg',
        			'format'=> 'text',
        			'value' => 'usero.nameUser',
			],
        	[ 'attribute' => 'userNameRun',
        		'format'=> 'text',
        		'value' => 'userr.nameUser',
        		],
         		
         		[ 'attribute' => 'nameTypeSender',
         		'format'=> 'text',
         		'value' => 'regout.typeSender',
         		],
             'listNumber',
             'countList',
          
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <?php \yii\widgets\Pjax::end();?>
</div>
