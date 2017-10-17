<?php
namespace common\assets;

use yii\web\AssetBundle;

class ComAsset extends AssetBundle
{
	
	public $basePath = '@common';
	//public $baseUrl ='@web';

	
	public $js = [
			  'common/js/ajx.js'
	];
	
}