<?php

	function make_null($value){
        $value = $value->toArray();
        array_walk_recursive($value, function (&$item, $key) {
            $item =  $item === null ? "" : $item;
        });
        return $value;
    }
	function uploadModalReferenceFile($files,$upath ,$refe_table_field_name ,$ref_field_id , $type )
    {
		
		$path = public_path() .'/'. $upath;	
		
		$upload = 0;
		
        foreach ($files as $i => $file) {

			$timestamp = uniqid();
			$real_name = $file->getClientOriginalName();
			$name = $timestamp."_".$real_name;
			$extension = $file->getClientOriginalExtension();
			
			$file->move($path,$name);
			
			$requestData = array();
			$requestData['refe_file_path'] = $upath;
			$requestData['refe_file_name'] = $name;
			$requestData['refe_file_real_name'] = $real_name;
			$requestData['refe_field_id'] = $ref_field_id;
			$requestData['refe_table_field_name'] = $refe_table_field_name;
			$requestData['refe_type'] = $type;
			\App\Refefile::create($requestData);
            
			$upload++;
			
		}
        
     
        return $upload;
		
    }
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}

    
?>