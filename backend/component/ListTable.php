<?php
namespace  backend\component;


use yii\base\Widget;
use yii\helpers\Html;


class ListTable extends Widget
{
	public $selected;
	public $items;
	public $id;
	public $name;
	
	public function init()
	{
		parent::init();
	
		//$this->selected  = Typemat::className(); 
	}
	
	public function run()
	{
		$html = '';
		
		
		
		
		$html = $html.Html::dropDownList($this->name, $this->selected, $this->items, ['id' => $this->id] );
		


		//$arr = Dataexcel::getTableSchema();
		return $html;
		
		
	}

}