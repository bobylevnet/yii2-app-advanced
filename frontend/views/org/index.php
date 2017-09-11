<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Org', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idOrg',
            'nameOrg',
            'adresMail',
            'adresTrans',
            'orgKks',
            // 'numDog',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
