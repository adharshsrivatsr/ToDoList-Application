<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Task;
use App\Priority;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Task::with('priorities')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'priority'=>'required'
            
        ]);
        
        $task=new Task();
        $task->name=$request['name'];
        $task->save();
        $priorityIds=[];
        foreach ($request->priority as $priority) {
            $priorityIds[]=Priority::where('priority',$priority)->first()->id;
        }
        $task->priorities()->attach($priorityIds);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
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
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'name'=>'required',
            'priority'=>'required'
            
        ]);

        $task->name=$request["name"];
        $task->status=$request["status"];
        if($request["time"]!= null) {
            $task->completed_at=Carbon::now();
        }
        else
            $task->completed_at=null;
        $task->save();

        $priorityIds=[];
        foreach ($request->priority as $priority) {
            $priorityIds[]=Priority::where('priority',$priority)->first()->id;
        }
        
        $task->priorities()->sync($priorityIds);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }
}
