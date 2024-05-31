<?php

namespace App\Http\Controllers\api;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    //checkin
    public function checkin(Request $request)
    {

        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        //create save new attendance
        $attendance = new Attendance();
        $attendance->user_id = $request->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->latlon_in = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        return response([
            'message' => 'Checkin Success',
            'attendance' => $attendance
        ], 200);
    }


    //checkout
    public function checkout(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);


        // get checkin attendance
        $attendance = Attendance::where('user_id', $request->user()->id)
        ->where('date', date('Y-m-d'))
        ->first();

        // check if checkin
        if (!$attendance) {
            return response([
                'message' => 'Checking first'
            ], 401);
        }

        $attendance->time_out = date('H:i:s');
        $attendance->latlon_out = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        return response([
            'message' => 'Checkout Success',
            'attendance' => $attendance
        ], 200);
    }


    //check is checked in
    public function isChecked(Request $request)
    {
        $attendance = Attendance::where('user_id', $request->user()->id)
        ->where('date', date('Y-m-d'))
        ->first();

        return response([
            'is_checkin' => $attendance ? true : false
        ], 200);
    }
}
