<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use frontend\component\bobyii2excel\ExcelReader;


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
                    $xlsx = new  ExcelReader();
              
                    foreach ($this->excelFiles  as $file) {
                        $i++;
                       $path = \Yii::getAlias('@app').'/upload/'. $file->baseName . '.' . $file->extension;
                       $file->saveAs($path);
                      
                      $result[$i] = $xlsx->parseExcel($path);
                  
                    }
                      $this->column  =implode($result);
                   
			
                            
                           
                        
                    }
		 else {
			return false;	
		}
                
	}
        
}