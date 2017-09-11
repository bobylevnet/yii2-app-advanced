<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
   use yii\widgets\ListView;
   use yii\widgets\ActiveForm;
   
$this->title = 'Шаблоны';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>



</div>

<div class="row">
 
    <div class="col-sm-3">   
    <?php

echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_files',
]);



?>
    </div>
    

 <div class="col-sm-8"> 

<?php
$form = ActiveForm::begin();

    $params = [
        'prompt' => 'Выберите шаблон'
    ];
        echo $form->field($model, 'nametemplate')->dropDownList($templateList,$params);
        
    ActiveForm::end();


?>
</div>
    
    
</div>

