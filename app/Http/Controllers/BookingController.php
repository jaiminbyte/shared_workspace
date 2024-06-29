<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Workspace;
use App\Models\Customer;
use App\Models\Conference;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::get();
        if(isset($booking) && count($booking) > 0){
            foreach ($booking as $key => $value) {
                $workspace_id = isset($value->workspace_id) ? $value->workspace_id : 0;
                $conference_id = isset($value->conference_id) ? $value->conference_id : 0;
                $customer_id = isset($value->customer_id) ? $value->customer_id : 0;
                $value->workspace = $workspace = Workspace::where('id',$workspace_id)->first();
                $value->workspace_name = isset($workspace->name) ? $workspace->name : '';
                $users = Customer::where('id',$customer_id)->first();
                $first_name = isset($users->first_name) ? $users->first_name : '';
                $last_name = isset($users->last_name) ? $users->last_name : '';
                $value->customer_name = $first_name . ' ' . $last_name;
                $value->conference = Conference::where('workspace_id',$workspace_id)->where('id',$conference_id)->first();
            }
        }
        return response()->json(['msg' => '','data'=>$booking, 'status' => true],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'workspace_id' => 'required',
            'state_of_booking' => 'required',
            'payment' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $request->request->add(['booking_date' => date('Y-m-d')]);
        Booking::create($request->all());
        return response()->json(['msg' => 'Booking Added succesfully','data'=>[], 'status' => true],200);
    }

    public function show($id)
    {
        $data = Booking::findOrFail($id);
        $workspace_id = isset($data->workspace_id) ? $data->workspace_id : 0;
        $conference_id = isset($data->conference_id) ? $data->conference_id : 0;
        $customer_id = isset($data->customer_id) ? $data->customer_id : 0;
        $data->workspace = $workspace = Workspace::where('id',$workspace_id)->first();
        $data->workspace_name = isset($workspace->name) ? $workspace->name : '';
        $users = Customer::where('id',$customer_id)->first();
        $first_name = isset($users->first_name) ? $users->first_name : '';
        $last_name = isset($users->last_name) ? $users->last_name : '';
        $data->customer_name = $first_name . ' ' . $last_name;
        $data->conference = Conference::where('workspace_id',$workspace_id)->where('id',$conference_id)->first();
        return response()->json(['msg' => '','data'=>$data, 'status' => true],200);
    }

    public function update(Request $request, $id)
    {
        $Booking = Booking::findOrFail($id);

        $request->validate([
            'workspace_id' => 'required',
            'state_of_booking' => 'required',
            'payment' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $Booking->update($request->all());

        return response()->json(['msg' => 'Booking Updated succesfully','data'=>[], 'status' => true],200);
    }

    public function destroy($id)
    {
        $Booking = Booking::findOrFail($id);
        $Booking->delete();

        return response()->json(['msg' => 'Booking deleted succesfully','data'=>[], 'status' => true],200);
    }
}
