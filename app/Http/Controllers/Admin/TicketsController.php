<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Tickets;

use Illuminate\Http\Request;
use Session;
use App\User;
use Carbon;

use DataTables;

class TicketsController extends Controller
{


    public function __construct()
    {
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
		/*$ids = [];
		$record = Tickets::all();
		foreach($record as $rec){
			if($rec->user){
				
			}else{
				$ids[] = $rec->id;
			}
		}
		Tickets::whereIn("id",$ids)->delete();
		echo "<pre>"; print_r($ids); exit;*/
		
		$users = User::where("id",">",0)->get();
		
        return view('admin.tickets.index',compact('users'));
    }
    
    public function datatable(Request $request) {

       
        

        $record = Tickets::with(['user']);
		
		if($request->has('user_id') && $request->user_id != ""){
			$record->where('user_id',"=",$request->user_id);
		}
		if($request->has('status') && $request->status != ""){
			$record->where("status",$request->status);
		}
        
		if ($request->has('range_start') && $request->get('range_start') != '') {
            $sdate =  Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$request->range_start." 00:00:00");
            $edate =  Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$request->range_end." 23:59:59");
            $record->whereBetween('created_at', [$sdate, $edate]);
        }

        return Datatables::of($record)->make(true);
    }
    
    public function show($id,Request $request)
    {
		$item = Tickets::where("slug",$id)->first();
		if(!$item){
			Session::flash('flash_error',"Data not found");
            return redirect('admin/tickets');
		}
		
		return view('admin.tickets.show',compact('item'));
	}
	
	public function store(Request $request)
    {
        $result = array();

        $rules = array(
            'subject' => 'required'
        );
		$val_msg = [
			'content.required'=> "Ticket Description Is Required"
		];
        $validator = \Validator::make($request->all(), $rules, $val_msg);

        if ($validator->fails())
        {
            $validation = $validator;
            $msgArr = $validator->messages()->toArray();
            $messages = reset($msgArr)[0];

            return response()->json(['message' =>$messages,'success' => false,'status' => 400],400);
        }
		$uid = MD5(uniqid());
        $requestData = $request->except(['coupon_id']);
        $requestData['created_by'] = \Auth::user()->id;
        $requestData['updated_by'] = \Auth::user()->id;
        $requestData['hascode'] = $uid;
		$requestData['status'] = "open";
		
		$exp_date = Carbon\Carbon::now()->addDays(2)->format("Y-m-d");
		$requestData['content'] = json_encode(['exp_date'=>$exp_date,'total_file'=>0,'total_size'=>0,'desc'=>$request->content]);
       
        $module = Tickets::create($requestData);
        if($module){
			
			$path = public_path('ticket-files') .'/'.$uid;
			\File::exists($path) or mkdir($path, 0777, true);
			
            $result['message'] = \Lang::get('comman.responce_msg.item_created_success',['item'=>"Ticket"]);
            $result['code'] = 200;
        }else{
            $result['message'] = \Lang::get('comman.responce_msg.something_went_wrong');
            $result['code'] = 400;
        }
        return response()->json($result, $result['code']);

    }

    
    public function assignUser(Request $request)
    {
       

        $ticket = Tickets::where("id",$request->ticket_id)->first();
        $user = User::where("id",$request->user_id)->first();

       

        $result = array();
       
	   if(!$ticket || !$user){
            $result['message'] = "No ticket found";
            $result['code'] = 400;
        }else{
            $ticket->user_id = $request->user_id;
            $ticket->save();

            $result['message'] = "Ticket Assign To ".$user->full_name;
            $result['code'] = 200;
        }

        return response()->json($result, $result['code']);

    }
	
	public function changestatus(Request $request)
    {
       
		$ticket = null;
		
		if($request->has('status') && $request->status != ""){
			$ticket = Tickets::where("id",$request->ticket_id)->first();
		}
        $result = array();
		
		
       
		if(!$ticket){
            $result['message'] = "No ticket found";
            $result['code'] = 400;
        }else{
            $ticket->status = $request->status;
			
			if($request->has('status') && $request->status = "closed"){
				$ticket->closed_at = \Carbon\Carbon::now();
				
				$uid = $ticket->hascode;
				if($uid && $uid != ""){
					$path = public_path('ticket-files') .'/'.$uid;
					if(\File::exists($path)){
						\File::deleteDirectory($path);
					}
				}
			}
            $ticket->save();

            $result['message'] = "Ticket Status Updated ";
            $result['code'] = 200;
        }

        return response()->json($result, $result['code']);

    }
	public function document(Request $request)
    {
       
		$ticket = null;
		
		if($request->has('ticket_id') && $request->ticket_id != ""){
			$ticket = Tickets::where("id",$request->ticket_id)->first();
		}
        
		
		if(!$ticket){
            Session::flash('flash_error',"No ticket found");
            return redirect('admin/tickets');
        }else{
            if($request->hasFile('images'))
			{
				$files = $request->file('images');
				uploadModalReferenceFile($files,'ticket-files/'.$ticket->hascode,'ticket_id',$request->ticket_id,'ticket_image');
			}
			
			$total_size = 0;
			foreach($ticket->refefile as $rf){
				$total_size = $total_size + \File::size($rf->file_path);
			}
			
			$saz = formatSizeUnits($total_size);
			
			$ticket->content = json_encode(['exp_date'=>$ticket->exp_date,'total_file'=>$ticket->refefile->count(),'total_size'=>$saz,'desc'=>$ticket->desc]);
			
			$ticket->save();

			Session::flash('flash_success',"File uploaded!");
            return redirect('admin/tickets/'.$ticket->slug);
		}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id,Request $request)
    {
       
    }
}
