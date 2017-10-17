<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\component\bobyii2excel\ExcelReader;


class UploadFormExcel extends Model
{
	/**
         * @var UploadedFile[]
        */
	public $excelFiles;
	public  $column;
        
	public function rules()
	{
		return [
				[['excelFiles'], 'file', 'skipOnEmpty' => false, 'extensions'=>'xlsx', 'maxFiles'=>10, 'maxSize'=>1024*1024*10],
                                [['column'],'safe'],
		];
	}
	
	public function upload()
	{	
            
            
       
		if ($this->validate()) {   
                    $i=0;
                    
              
                    foreach ($this->excelFiles  as $file) {
                        $i++;
                   
                       $path = \Yii::getAlias('@app').'/upload/'. $file->baseName . '.' . $file->extension;
                             $file->saveAs($path);
                            $xlsx = new  ExcelReader($path,$file->baseName);
                 
                      
                      $result[$i] = $xlsx->parseExcel(['first'=>true]);
                  
                    }
                      $this->column  =implode($result);
                   
			
                            
                           
                        
                    }
		 else {
			return false;	
		}
                
	}
        
}