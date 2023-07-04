<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
	protected $table = 'tickets';
	
	
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
	
	
	public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
			$model->slug = rand(10,99).uniqid().rand(100,999);	
		});
		static::created(function ($model) {
          
        });
        static::updated(function ($model) {
           
        });
    }
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	public function creator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
	
	protected $appends = ['created','closed_at_tz','total_file','total_size','exp_date','desc','file_url'];
	
	public function getCreatedAttribute()
    {
        if($this->created_at != "" && $this->created_at){
            return \Carbon\Carbon::parse($this->created_at)->format(session('setting.date_format',\config('settings.date_format_on_app')));
        }
        return $this->created_at;
    }
	public function getClosedAtTzAttribute()
    {
        if($this->closed_at != "" && $this->closed_at && $this->status == "closed"){
            return \Carbon\Carbon::parse($this->closed_at)->format(session('setting.date_format',\config('settings.date_format_on_app')));
        }
        return "-";
    }
	public function getFileUrlAttribute()
    {
		$file_url = "";
        if($this->hascode != "" && $this->hascode){
			$file_url = url('ticket-files')."/".$this->hascode;
		}
        return $file_url;
    }
	public function getTotalFileAttribute()
    {
		$total_file = 0;
        if($this->content != "" && $this->content){
			$content = json_decode($this->content,true);
			if(is_array($content) && isset($content['total_file'])){
				$total_file = $content['total_file'];
			}
        }
        return $total_file;
    }
	public function getTotalSizeAttribute()
    {
		$total_size = 0;
        if($this->content != "" && $this->content){
			$content = json_decode($this->content,true);
			if(is_array($content) && isset($content['total_size'])){
				$total_size = $content['total_size'];
			}
        }
        return $total_size;
    }
	public function getExpDateAttribute()
    {
		$exp_date = "-";
        if($this->content != "" && $this->content){
			$content = json_decode($this->content,true);
			if(is_array($content) && isset($content['exp_date'])){
				$exp_date = $content['exp_date'];
			}
        }
        return $exp_date;
    }
	public function getDescAttribute()
    {
		$desc = "";
        if($this->content != "" && $this->content){
			$content = json_decode($this->content,true);
			if(is_array($content) && isset($content['desc'])){
				$desc = $content['desc'];
			}
        }
        return $desc;
    }
	
	
	public function refefile()
    {
        return $this->hasMany('App\Refefile', 'refe_field_id', 'id')->where('refe_table_field_name', 'ticket_id');
    }
	
}
