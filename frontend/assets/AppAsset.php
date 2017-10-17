<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use common\assets\ComAsset;
/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	

	public $basePath = '@webroot';
	public $baseUrl ='@web';
	
    public $css = [
            'css/site.css',
    ];
    
   public $js = [
    	
    		'js/_pjax.js',
    ];
    
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
      	'common\assets\ComAsset',
    ];
}
