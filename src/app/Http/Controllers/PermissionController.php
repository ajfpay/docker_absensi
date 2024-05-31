<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = Permission::with('user')
            ->when(
                $request->input('name'),
                function ($query, $name) {
                    $query->whereHas('user', function ($query) use ($name) {
                        $query->where('name', 'like', '%' . $name . '%');
                    });
                }
            )->orderBy('id', 'desc')->paginate(10);
        return view('pages.permission.index', compact('permissions'));
    }

    //view
    public function show($id) {
        $permission = Permission::with('user')->find($id);
        return view('pages.permission.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        $permission = Permission::with('user')->find($permission->id);
        return view('pages.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->is_approved = $request->is_approved;
        $permission->save();
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //delete permission
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
