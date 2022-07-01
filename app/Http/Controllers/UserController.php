<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // function __construct(){
    //     $this->middleware('userAuthCheck');
    // }

    public function create()
    {

        return   view('users.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name'     => 'required|min:3|max:15',
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
        $data['password']  = bcrypt($data['password']);
        $op = DB::table('users')->insert($data);

        if ($op) {
            $message = "User Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "User Not Created";
            session()->flash('Message-error', $message);
        }
        return redirect(url('users/create'));
    }

    public function index()
    {
        $users =  User::get();
        return view('users.index', ['data' => $users]);
    }


    public function remove($id)
    {

        $user = DB::table('users')->find($id);

        $op = DB::table('users')->where('id', $id)->delete();

        if ($op) {
            $message = "User Removed Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "User Not Removed";
            session()->flash('Message-error', $message);
        }

        return redirect(url('users'));
    }

    public function edit($id)
    {

        $data = DB::table('users')->find($id);

        return view('users.edit',['data'=>$data]);

    }

    public function update(Request $request, $id)
    {

        $data =  $this->validate($request, [
            'name'     => "required",
            'email'    => "required|email",
        ]);

        $op = DB::table('users')->where('id', $id)->update($data);

        if ($op) {
            $message = "User Updated Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "User Not Updated";
            session()->flash('Message-error', $message);
        }

        return redirect(url('users'));
    }


}