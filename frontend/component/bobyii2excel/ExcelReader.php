<?php
namespace frontend\component\bobyii2excel;




class ExcelReader 
{
	
	private $handle;
        public $data;
        private $dir;
        static $strings;
        static $sheet;
        static $xlrows;
        static $fileExcel;
        static $countRow;
        static $baseName;
                
	function __construct($fileExcel,$baseName) 
	{
            
                 ExcelReader::$fileExcel = $fileExcel;
                 str_replace(".", "", $baseName);
           	$this->dir = \Yii::getAlias('@app') . "\\export\\".$baseName;	
            
                   file_exists($this->dir)? :  mkdir($this->dir);
                $zip = new \ZipArchive();    
		$zip->open($fileExcel);
                $zip->extractTo($this->dir);
              
          
               ExcelReader::$strings = simplexml_load_file($this->dir.'\\xl\\sharedStrings.xml');
               ExcelReader::$sheet   = simplexml_load_file($this->dir . '\\xl\\worksheets\\sheet1.xml');
                
               ExcelReader::$xlrows = ExcelReader::$sheet->sheetData->row;
                        ExcelReader::$countRow = count(ExcelReader::$xlrows);
                        ExcelReader::$baseName = $baseName;
        }
        
        

        
        public function parseExcel($options)
        {
            
            
           
                $i=0;

                  $arr = array();
                //РїСЂРѕС…РѕРґ РїРѕ СЃС‚СЂРѕРєР°Рј
     
               foreach (ExcelReader::$xlrows as $xlrow) {
                 
                   
                   $i++;
                
                 //РїСЂРѕС…РѕРґ РїРѕ СЏС‡РµРєР°Рј СЃС‚СЂРѕРєРё
                    foreach ($xlrow->c as $cell) {
                        
                    $v = (string) $cell->v;  
                    if( $v=="343" )
                       {
                        echo ""; 
                       }
                  // $v = (string) $cell;    
                 // РЎРјРѕС‚СЂРёРј Р·РЅР°С‡РµРЅРёСЏ С‚РёРїР° СЏС‡РµР№РєРё
                    // if (isset($cell['t']) && $cell['t']!='s')
                    //{                        
                    //     echo '';s
                    // }
                   if (isset($cell['t'])) {
                      $s  = array();
                     $si = ExcelReader::$strings->si[(int) $v];
            
            // РџСЃРµРІРґРѕРЅРёРј РїСЂРѕСЃС‚СЂР°РЅСЃС‚РІР° РёРјРµРЅ  
            $si->registerXPathNamespace('n', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
            $node= $si->xpath('.//n:t');
            // Р·РЅР°С‡РµРЅРёРµ РІСЃРµС… СѓР·Р»РѕРІ С‚РµРєСЃС‚
            foreach($node as $t) {
                $s[] = (string) $t;
            }
            $v = implode($s);
        }
        
        $arr[$i][] = $v;
    }
    
     if ($options['first']==true) {
            return $this->getHtml($arr,   ExcelReader::$fileExcel, ExcelReader::$baseName );
        }
        
      $dom = dom_import_simplexml($xlrow);
      $dom->parentNode->removeChild($dom);
      $p = count(ExcelReader::$xlrows);
       ExcelReader::$countRow = count(ExcelReader::$xlrows);
      return $arr;
       
        
     }
     
        //return $arr;
        }
  
  
  
   function getHtml($arr,$fileExcel, $baseName)
    {
    $column = " </br> <table class='tbl'>  <tr> <td>"
            ."<span>Р¤Р°Р№Р» - ".$fileExcel."</span> </br>"
            . " <span>РћРїРёСЃР°РЅРёРµ С„Р°Р№Р»Р°</span> </br>"
            . " <input name='comment' type='text' > </br>"
            . "<a  href='#'>Р�РјРїРѕСЂС‚</a> </br> "
            . "<span name='load'> </span>"
            . "<input name='pathfile' type='hidden' value='".$fileExcel."' >"
            . "<input name='namefile' type='hidden' value='".$baseName."' > </td> </tr> ";
    $ind=0;
    foreach($arr[1]  as $key => $value)
    { 
        $ind++;
        if ($ind==10)
        {
            
        $column =  '<tr>'. $column .  '<td>'.$value . '   <input type="checkbox" value='.$key.'>  </td>'.'</tr>';
        $ind=0;
        }
        else
        {
               $column =   $column.'<td>'.$value.  '  <input type="checkbox" value='.$key.'>  </td>';
               
        }
    }	
	$column =  $column	. "</tr> </table></br> ";
       
        return $column;
      
    }
    
}
        
