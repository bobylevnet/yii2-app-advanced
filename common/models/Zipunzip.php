<?php

namespace common\models;


class Zipunzip
{
	
	public function ExtactFile($file, $to)
	{
		
	}
	
	
	public function ArchiveFile($path, $to)
	{
		
		
		
		$path=realpath($path);
		
		$zip = new \ZipArchive();
		$path= str_replace('/','\\', $path );
		$to= str_replace('/','\\', $to );
		
		$nameFile = $path.'\\'.'letter'.time().'.zip';

		if ($zip->open($nameFile,\ZipArchive::CREATE)===TRUE){		
		
	
	
		
		if (is_dir($path))
		{
			$pathSource= $path. '\\';
		$directory = new \RecursiveDirectoryIterator($path);
		$files = new \RecursiveIteratorIterator($directory,  \RecursiveIteratorIterator::SELF_FIRST );
		}
		
		
		
		
		foreach ($files as $name=>$file)
		{
			
			
			if (in_array(substr($name, strrpos($name,'\\')+1), array('.','..')))
			{
				continue;
			}
			
		 if 	(is_file($name)===TRUE) {
				
		 	$zip->addFile($name, str_replace($pathSource, "", $name));
			 }

		}
		
		
			$zip->close();
		
			$newName = $to.'\\fileready.xlsx';
			rename($nameFile, $newName);
		
			return $newName;
		}
	}
	
	
}