<?php
namespace frontend\component\bobyii2excel;

use Behat\Gherkin\Exception\Exception;


class ExcelReader 
{
	
	private $handle;
	
	function __construct($fileExcel) 
	{
		$zip = new \ZipArchive(); 
                    
		$stat = $zip->open($fileExcel);
                
                
                
		if ($stat!=true) { new \Exception('���� '.$fileExcel.' �� ��������');}
		
		
	}
	
	public function columnExcel()
	{
		
		
	}
	
	
	
	
	
	
	
}