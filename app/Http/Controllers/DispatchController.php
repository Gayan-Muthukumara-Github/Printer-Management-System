<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerRequest;
use App\Models\CustomerRequestComments;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;

class DispatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customerRequests = CustomerRequest::all();
        return view('dispatch.index', [
            'customerRequests' => $customerRequests
        ]);
    }

    public function get_requests($id)
    {
        $customerRequest = CustomerRequest::find($id);
        if($customerRequest->request_type == "Toner Request"){
            return view('dispatch.toner-details', compact('customerRequest'));
        } 
    }

    public function post_comment($id, Request $request)
    {
        CustomerRequestComments::create([
            'customer_request_id' => $id,
            'comment' => $request->comment
        ]);
        return redirect('/dispatch');
    }

    public function request_dispatch($id, Request $request)
    {
        # code...
    }

    public function update_dispatch($id, Request $request)
    {
        $customerRequest = CustomerRequest::find($id);
        for ($x = 0; $x < count($request->details_id); $x++) {
            $detail = $customerRequest->details->where('id', '=', $request->details_id[$x])->first();
            $detail->status = "dispached";
            $detail->save();
        }
        $rec_count = $customerRequest->details->where('status', '=', 'pending')->count();
        if($rec_count == 0){
            $customerRequest->status = "completed";
            $customerRequest->save();
            
            $data = array();
    
            $contact = $customerRequest->contact;
            $email = $contact->email;
            $name = $contact->first_name;
    
            Mail::send('completed', $data, function($message) use ($name, $email)  {
                $message->to('shalingams@gmail.com', $name)->subject
                ('Toner Request Completed');
                $message->from('pms@gmail.com','Print Manage service');
            });
        }
        return redirect('/dispatch');
    }
}
