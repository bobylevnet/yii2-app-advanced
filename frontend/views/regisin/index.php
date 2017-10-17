<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regisins';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="regisin-create">
     
     
     



 <?= $this->render('@app/views/findOrg')?>
 
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
            'numberDoc',
        	'dateDoc',	
        	[ 'attribute'=>'nameOrg',
        		'format'=>'text',
        		'value'=>'org.nameOrg'
        	],
        	'dateIn',
        	'numberIn',
        	[ 'attribute'=>'nameTypeDoc',
        		'format'=>'text',
        		'value' => 'typed.nameTypeDoc',
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
             'listNumber',
             'countList',
          

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end()?>
</div>
