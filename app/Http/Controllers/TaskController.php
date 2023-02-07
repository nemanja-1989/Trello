<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TasksRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Board;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TasksRequest $request)
    {
        try{
            $tasks = Task::with(['boards', 'user', 'status'])
            ->whereIn('user_id', $request->get('users_id'))
                ->orWhereIn('status_id', $request->get('statuses_ids'))
                    ->paginate(12);
            return response()->json(['tasks' => $tasks]);
        }catch(\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try{
            $task = Task::create([
                'user_id' => $request->get('user_id'),
                'status_id' => $request->get('status_id'),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ]);
            $task->boards()->attach(Board::whereName(Status::whereId($request->get('status_id'))->first()->status_name)->first()->id);
            return response()->json(['task' => $task->load(['boards', 'user', 'status'])]);
        }catch(\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return response()->json(['task' => Task::with(['boards', 'user', 'status'])->whereId($id)->first()]);
        }catch(\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        try{
            $task = Task::whereId($id)->update([
                'user_id' => $request->get('user_id'),
                'status_id' => $request->get('status_id'),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ]);
            $task->boards()->sync(Board::whereName(Status::whereId($request->get('status_id'))->first()->status_name)->first()->id);
            return response()->json(['task' => $task->load(['boards', 'user', 'status'])]);
        }catch(\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Task::whereId($id)->first()->delete();
        }catch(\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
