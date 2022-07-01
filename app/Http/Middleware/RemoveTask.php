<?php

namespace App\Http\Middleware;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;

class RemoveTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $task = Task::where('id',$request->id)->get();
        $end_date = $task[0]->end_date;
        if($end_date > time()){
            return $next($request);
        } else{
            echo"Task Can't be deleted";
            return redirect(url('tasks'));
        }
    }
}