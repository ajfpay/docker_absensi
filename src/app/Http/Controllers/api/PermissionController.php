<?php

namespace App\Http\Controllers\api;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController
{
    //create permission
    public function store(Request $request) {   

        $request->validate([
            'date' => 'required',
            'reason' => 'required',
        ]);

        $permission = new Permission();
        $permission->user_id = $request->user()->id;
        $permission->date_permission = $request->date;
        $permission->reason = $request->reason;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/permissions', $image->hashName());
            $permission->image = $image->hashName();
        }

        $permission->save();

        return response([
            'message' => 'Permission created successfully',
        ], 201);

    }



}
