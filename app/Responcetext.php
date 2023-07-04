<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responcetext extends Model
{
	protected $table = 'responce_text';
	
	
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
	
	
	public static function rtext($slug){
		
		$rtext=Responcetext::whereSlug($slug)->first();
		if($rtext){
			return $rtext->desc;
		}else{
			return \config('constant.responce_msg.'.$slug);
		}
		
	}
	
}
