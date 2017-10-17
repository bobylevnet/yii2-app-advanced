<?php
namespace  app\component;

use common\models\Typedoc;
use common\models\Typemat;
use common\models\Org;
use common\models\Typesender;
use yii\base\Widget;
use yii\helpers\Html;


class ListTable extends Widget
{
	public $selected;
	
	public function init()
	{
		parent::init();
	
		//$this->selected  = Typemat::className(); 
	}
	
	public function run()
	{
		$html = '';
		$helpersName = [
					   Typemat::className()  =>  'Тип носителя',
				       Typedoc::className() => 'Тип документов' ,
				       Org::className() => 'Организации',
						Typesender::className() => 'Способ доставки',
		];

		
		
		
		$html = $html.Html::dropDownList('table',$this->selected, $helpersName, ['id' => 'helpDrop'] );
		


		//$arr = Dataexcel::getTableSchema();
		return $html;
		
		
	}

}