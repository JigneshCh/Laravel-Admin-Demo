<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Refefile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refe_file';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['refe_table_field_name', 'refe_field_id', 'refe_file_path','refe_file_name','refe_file_real_name', 'refe_code','refe_type'];
	
	protected $appends = ['file_url','file_path'];
	
	
	public function getFileUrlAttribute()
    {
		if($this->refe_file_path && $this->refe_file_name && \File::exists(public_path()."/".$this->refe_file_path."/".$this->refe_file_name)){
			return url('')."/".$this->refe_file_path."/".$this->refe_file_name;
		}else{
			return "";
		}
	}
	public function getFilePathAttribute()
    {
		if($this->refe_file_path && $this->refe_file_name && \File::exists(public_path()."/".$this->refe_file_path."/".$this->refe_file_name)){
			return public_path()."/".$this->refe_file_path."/".$this->refe_file_name;
		}else{
			return "";
		}
	}


   


}
