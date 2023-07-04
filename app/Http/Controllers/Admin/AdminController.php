<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('admin.dashboard');
    }
	public function slugTicket(Request $request){
		$tickets = \App\Tickets::whereNull('slug')->limit(1000)->get();
		echo "Total ticket with no slug =>".$tickets->count();
		foreach($tickets as $ticket){
			$ticket->slug = rand(10,99).uniqid().rand(100,999);	
			$ticket->save();
		}
		
		
	}
	public function newAllUserTicket(Request $request){
		if($request->has('alluser') && $request->alluser == "all"){
			$users = \App\User::where('utype','=','employee')->where('status','=','active')
			->inRandomOrder()
			->get();
			
			foreach($users as $user){
				$request->request->add(['user_id' => $user->id]);
				echo "<br/><b>".$user->id."</b>";
				$this->newUserTicket($request);
			}
		}else{
			$this->newUserTicket($request);
		}
	}
	public function newUserTicket(Request $request)
    {
		//$ticket = \App\Tickets::whereIn("slug",["625f48d1cd98a69883","695f48d6b08bbbe547"])->get();
		//\App\Tickets::whereIn("slug",["625f48d1cd98a69883","695f48d6b08bbbe547"])->delete();
		//dd($ticket);
		//dd(Carbon::now()->endOfWeek()->dayOfWeek);
		if($request->has('user_id') && $request->has('start_date') && $request->has('end_date')){
			$user = \App\User::whereId($request->user_id)->first();
			$start_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->start_date);
			$end_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->end_date);
			
			if($end_date > \Carbon\Carbon::now()){
				$end_date = \Carbon\Carbon::now();
			}
			if($user){
				
				if($start_date < $end_date){
					$day = 0;
					while ($start_date <= $end_date) {
						//echo $day."-".$start_date."<br/>";
						
						$weekd = $start_date->dayOfWeek;
						if($weekd ==1){
							echo "<br/>#Create: ".$start_date."(".$start_date->format('D').")";
							$this->createNew($user->id,$start_date);
						}
						if($weekd ==0){
							echo "<br/>#Close: ".$start_date."(".$start_date->format('D').")";
							$this->freeEmployee($user->id,$start_date);
						}
						
						$start_date->addDay();
						$day = $day + 1;
					}
				}
			}
		}
    }
	public function freeEmployee($user_id,$datetime)
    {
		$_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$datetime);
		
		$tickets = \App\Tickets::where('status','!=','closed')->where('user_id',$user_id)->where('created_at','<',$_date)->get();
		foreach($tickets as $ticket){
			
			$start = strtotime($_date->format("Y-m-d")." 10:00:00");
			$end =  strtotime($_date->format("Y-m-d")." 13:00:00");
			
			$start2 = strtotime($_date->subDays(1)->format("Y-m-d")." 10:00:00");
			$end2 =  strtotime($_date->subDays(1)->format("Y-m-d")." 23:00:00");
			
			$start3 = strtotime($_date->subDays(1)->format("Y-m-d")." 15:00:00");
			$end3 =  strtotime($_date->subDays(1)->format("Y-m-d")." 23:00:00");


			$arr = [date("Y-m-d H:i:s", rand($start, $end)),date("Y-m-d H:i:s", rand($start2, $end2)),date("Y-m-d H:i:s", rand($start3, $end3))] ;
			$key = array_rand($arr);
		
			$ticket->status = 'closed';
			$ticket->closed_at = $arr[$key];
			$ticket->updated_at = $arr[$key];
			$ticket->save();
			echo " : ".$ticket->id;
			
			$uid = $ticket->hascode;
			if($uid && $uid != ""){
				$path = public_path('ticket-files') .'/'.$uid;
				if(\File::exists($path)){
					\File::deleteDirectory($path);
				}
			}
		}
	}
	public function createNew($user_id,$datetime)
    {
		$tickets = \App\Tickets::where('user_id',$user_id)
		->whereBetween('created_at',[$datetime->format("Y-m-d")." 00:00:00",$datetime->format("Y-m-d")." 23:59:59"])
		->get();
		$admins = \App\User::where('utype','admin')->pluck('id')->toArray();
		
		
		if($tickets->count() > 0){
			echo " : EXist ".$tickets->count();
			return 0;
		}
		if(is_array($admins) && isset($admins[0])){
			
		}else{
			$admins = [1];
		}
		
		$start = strtotime($datetime->format("Y-m-d")." 09:00:00");
		$end =  strtotime($datetime->format("Y-m-d")." 13:00:59");
		
		$randomDate = date("Y-m-d H:i:s",rand($start, $end));
		
		$subject_time = Carbon::createFromFormat("Y-m-d H:i:s",$randomDate)->format('jS')." - ".Carbon::createFromFormat("Y-m-d H:i:s",$randomDate)->addDays(5)->format('jS M Y');
		$exp_date = Carbon::createFromFormat("Y-m-d H:i:s",$randomDate)->addDays(2)->format('Y-m-d');
		$total_file = rand(1,3);
		$total_size = rand(2,100) * 1048576 + rand(100,1048576);
		$saz = formatSizeUnits($total_size);
		$uid = MD5(uniqid());
		
		$admin_id = $admins[array_rand($admins)];
		
		$data = array(
			'subject' => 'Data Processing ticket ('.$subject_time.')',
			'content' => json_encode(['exp_date'=>$exp_date,'total_file'=>$total_file,'total_size'=>$saz,'desc'=>'']),
			'created_by' => $admin_id,
			'updated_by' => $admin_id,
			'hascode' => $uid,
			'user_id' => $user_id,
			'status' => 'open',
			'created_at' => $randomDate,
			'updated_at' => $randomDate,
		);
		//echo "<pre>"; print_r($data);
		$module = \App\Tickets::create($data);
		echo " : ".$module->id;
		
		$path = public_path('ticket-files') .'/'.$uid;
		\File::exists($path) or mkdir($path, 0777, true);
	}
}
