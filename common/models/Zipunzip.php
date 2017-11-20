<?php

namespace common\models;


class Zipunzip
{
	
	public function ExtactFile($file, $to)
	{
		
	}
	
	
	public function ArchiveFile($path, $to)
	{
		
		$path= str_replace('/','\\', realpath($path) );
		//$zip = new \ZipArchive();
		//$zip->open($path);
	
		
		if (is_dir($path))
		{
			$path= $path. '\\';
		$directory = new \RecursiveDirectoryIterator($path);
		$iterator = new \RecursiveIteratorIterator($directory,  \RecursiveIteratorIterator::SELF_FIRST );
		}
		
		
		foreach ($files as $file)
		{
			
		}
	}
	
	
}