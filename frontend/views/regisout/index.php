<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Regisout */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regisouts';
$this->params['breadcrumbs'][] = $this->title;
?>


 <div id="searorg">
    </div> 
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>




<div class="regisout-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Regisout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRout',
            'idOrg',
            'idTypDocum',
            'idTypeMat',
            'aboutDoc',
            // 'dateDoc',
            // 'numberDoc',
            // 'yearDoc',
            // 'idUserRun',
            // 'idUserOrg',
            // 'senderType',
            // 'senderDate',
            // 'returnDate',
            // 'listNumber',
            // 'countList',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
