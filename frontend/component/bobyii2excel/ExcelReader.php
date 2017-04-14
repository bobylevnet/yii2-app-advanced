<?php
namespace frontend\component\bobyii2excel;

use Behat\Gherkin\Exception\Exception;


class ExcelReader 
{
	
	private $handle;
        public $data;
     
	
	function __construct() 
	{
           		
        }
        
        
        function parseExcel($fileExcel)
        {
              $i=0;
		$zip = new \ZipArchive(); 
                    
		$zip->open($fileExcel);
                
                $dir = \Yii::getAlias('@app') . "\\export";
                
                $zip->extractTo($dir);
                
                $strings = simplexml_load_file($dir . '\\xl\\sharedStrings.xml');
                $sheet   = simplexml_load_file($dir . '\\xl\\worksheets\\sheet1.xml');
               
                $xlrows = $sheet->sheetData->row;
                  $arr = array();
                //проход по строкам
               foreach ($xlrows as $xlrow) {
                   $i++;
               
    
              
                 //проход по ячекам строки
                     foreach ($xlrow->c as $cell) {
                     $v = (string) $cell->v;    
                     //
                  
                 // Смотрим значения типа ячейки
                     
                     if (isset($cell['t']) && $cell['t']!='s')
                     {                        
                         echo '';
                     }
                   if (isset($cell['t'])) {
                      $s  = array();
                     $si = $strings->si[(int) $v];
            
            // Псевдоним пространства имен  
            $si->registerXPathNamespace('n', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
            // значение всех узлов текст
            foreach($si->xpath('.//n:t') as $t) {
                $s[] = (string) $t;
            }
            $v = implode($s);
        }
        
        $arr[$i][] = $v;
    }
    
                
		
    $column = "<span>" .$fileExcel.  " </span> <a href='#' onclick = imprtHref()>Импорт</a> </br> <table> <tr>";
    $ind=0;
    foreach($arr[1]  as $key => $value)
    { 
        $ind++;
        if ($ind==10)
        {
            
        $column =  '<tr>'. $column .  '<td>'.$value . '   <input type="checkbox" value='.$key.'/>  </td>'.'</tr>';
        $ind=0;
        }
        else
        {
               $column =   $column.'<td>'.$value.  '  <input type="checkbox" value='.$key.'/>  </td>';
               
        }
    }	
	$column =  $column	. "</tr> </table></br> ";
       
        return $column;
      
    }
	
	
        }
}