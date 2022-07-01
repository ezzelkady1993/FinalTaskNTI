<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    function __construct(){
        $this->middleware('userAuthCheck');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tasks')
            ->join('users', 'tasks.added_by', '=', 'users.id')
            ->select('tasks.*', 'users.name')
            ->get();

        return view('tasks.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =  User::get();
        return view('tasks.create', ['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            "title"          => "required | min:10 | max : 100",
            "content"        => "required|min:30 | max:400",
            "image"          => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "start_date"     => "required|date",
            "end_date"       => "required|date",
            "added_by"       => "required|numeric"
        ]);
        $imageName = time() . uniqid() . '.' . $request->image->extension();

        $data['start_date'] = strtotime($data['start_date']);
        $data['end_date']   = strtotime($data['end_date']);

        $request->image->move(public_path('images'), $imageName);

        $data['image'] = $imageName;

        $op = DB::table('tasks')->insert($data);
        if ($op) {
            $message = "Task Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Task Not Created";
            session()->flash('Message-error', $message);
        }

        return redirect(url('tasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tasks')->find($id);

        $op = DB::table('tasks')->where('id', $id)->delete();

        if ($op) {
            unlink(public_path('images/'.$data->image));

            $message = "Task Deleted Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Task Not Deleted";
            session()->flash('Message-error', $message);
        }

        return redirect(url('tasks'));
    }
}