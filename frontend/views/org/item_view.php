<?php use yii\helpers\Html;?>



 
<?= Html::tag('div', Html::hiddenInput('idOrg',$model['idOrg']).Html::tag('span',$model['nameOrg']), ['class'=>'item-list']);
?>
