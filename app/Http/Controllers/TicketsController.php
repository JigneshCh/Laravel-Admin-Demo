<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tickets;

use Illuminate\Http\Request;
use Session;


use DataTables;

class TicketsController extends Controller
{


    public function __construct()
    {
        
    }

   
    public function index(Request $request)
    {
        return view('frontend.index');
    }
    
    public function datatable(Request $request) {

       
        
		$record = Tickets::with(['user']);
		
		$record->where('user_id',"=",\Auth::user()->id);
		
		if($request->has('status') && $request->status != ""){
			$record->where("status",$request->status);
		}
        
		return Datatables::of($record)->make(true);
	}
    
    public function show($id,Request $request)
    {
		$item = Tickets::where("slug",$id)->first();
		if(!$item){
			Session::flash('flash_error',"Data not found");
            return redirect('/');
		}
		
		return view('frontend.tickets.show',compact('item'));
	}

    
    public function update($id, Request $request)
    {
       
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
}
