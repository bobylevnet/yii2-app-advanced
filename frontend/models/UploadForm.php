<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use frontend\component\bobyii2excel\ExcelReader;


class UploadForm extends Model
{
	/**
         * @var UploadedFile[]
        */
	public $excelFiles;
	
	public function rules()
	{
		return [
				[['excelFiles'], 'file', 'skipOnEmpty' => false, 'extensions'=>'xlsx', 'maxFiles'=>10],
		];
	}
	
	public function upload()
	{	
            
            
       
		if ($this->validate()) {               
                    foreach ($this->excelFiles  as $file) {
                       $path = \Yii::getAlias('@app').'/upload/'. $file->baseName . '.' . $file->extension;
                       
                        $xlsx = new  ExcelReader($path);
                        
                        
			$file->saveAs($path);
                    }
                    
                   
			
                            
                           
                        
                    }
		 else {
			return false;	
		}
                
	}
        
}