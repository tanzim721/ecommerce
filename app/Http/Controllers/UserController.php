<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'usertype', 'phone', 'address', 'created_at']);
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="'.route('users.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>
                            <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-user">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


}
