<?php

namespace App\Http\Controllers;
use App\Models\Toner;
use App\Models\Contact;
use App\Models\CustomerPortal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CustomerRequest;
use App\Models\CustomerRequestDetail;
use Mail;

class CustomerPortalController extends Controller
{
    public function index(){
        return view('customer-portal.index');
    }

    public function results(Request $request)
    {
        $contact = Contact::where('email', '=', $request->contract_id)->first();
        if($contact){
            $url = $contact->generate_login_link();
            $customer_portal = CustomerPortal::create([
                'customer_id' => $contact->id,
                'key' => $url
            ]);

            $host = request()->getHttpHost();
            
            $new_url = $host."/customer-portal/".$customer_portal->id."/".$url;

            $data = array('url'=>$new_url);
            $email = $contact->email;
            $name = $contact->first_name;

            Mail::send('mail', $data, function($message) use ($name, $email)  {
                $message->to('shalingams@gmail.com', $name)->subject
                   ('Access Grant Email');
                $message->from('pms@gmail.com','Print Manage service');
             });
            return redirect()->back()->with('message', 'Email send with access url');
        }else{
            return redirect()->back()->with('alert', "Email Not Found Please Retry");
        } 
    }

    public function welcome($id, $code)
    {
        $customer_portal = CustomerPortal::find($id);
        $currentTime = Carbon::now();
        if($customer_portal && $currentTime->diffInMinutes($customer_portal->created_at) < 1440){
            return view('customer-portal.welcome',[
                'customer_portal' => $customer_portal
            ]);
        }else{
            return redirect("/customer-portal")->with('alert', "Invalide url");
        }
    }

    public function toners($printer){
        $toners = Toner::where('printer_id', '=', $printer)->get();
        return $toners;
    }

    public function request(Request $request, $id)
    {
        $customerRequest = CustomerRequest::create([
            'request_type' => $request->request_type,
            'company_printer_id' => $request->printer_id,
            'customer_id' => $request->customer_id,
            'customer_portal_id' => $id,
            'contact_id' => $request->contact_id
        ]);
        for ($x = 0; $x < count($request->request_type_id); $x++) {
            CustomerRequestDetail::create([
                'customer_request_id' => $customerRequest->id,
                'request_type_id' => $request->request_type_id[$x],
            ]);
        }

        // send an email 
        $data = array(
            'customerRequest'=> $customerRequest,
            'details' => $customerRequest->details
        );

        $admin = $customerRequest->customer->company->users->where('admin', '=', 1)->first();
        $email = $admin->email;
        $name = $admin->first_name;

        Mail::send('request', $data, function($message) use ($name, $email)  {
            $message->to('shalingams@gmail.com', $name)->subject
            ('Toner Request Email');
            $message->from('pms@gmail.com','Print Manage service');
        });
        return redirect()->back()->with('message', 'Request Created Successfully');

    }
}