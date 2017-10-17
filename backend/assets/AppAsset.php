<?php

namespace backend\assets;

use yii\web\AssetBundle;
use common\assets\ComAsset;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
   
    public $css = [
        'css\site.css',
    ];
    
    public $js = [
    		'js\eventelement.js',	
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\ComAsset',
    ];
}
