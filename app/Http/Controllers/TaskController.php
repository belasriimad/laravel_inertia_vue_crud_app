<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        return $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::has('tasks')->get();
        $tasks = Task::with('category','user')->paginate(5);
        return Inertia::render('Tasks/Index',[
            'tasks' => $tasks,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return Inertia::render('Tasks/Create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        //
        if($request->validated()) {
            $task = new Task([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category_id,
            ]);

            auth()->user()->tasks()->save($task);
    
            return redirect()->route('home')->with([
                'message' => 'Task added successfully',
                'class' => 'alert alert-success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        $categories = Category::all();
        return Inertia::render('Tasks/Edit',[
            'categories' => $categories,
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        //
        if($request->validated()) {
            auth()->user()->tasks()->find($task->id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category_id,
                'done' => $request->done
            ]);
            
            return redirect()->route('home')->with([
                'message' => 'Task updated successfully',
                'class' => 'alert alert-success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();

        return redirect()->route('home')->with([
            'message' => 'Task deleted successfully',
            'class' => 'alert alert-success'
        ]);
    }

    public function getTasksByCategory(Category $category){
        $categories = Category::has('tasks')->get();
        return Inertia::render('Tasks/Index',[
            'tasks' => $category->tasks()->with("category","user")->paginate(5),
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function getTasksOrderedBy($column, $direction)
    {
        //
        $categories = Category::has('tasks')->get();
        return Inertia::render('Tasks/Index',[
            'tasks' => Task::with("category","user")->orderBy($column, $direction)->paginate(5),
            'categories' => $categories,
        ]);
    }

    public function getTasksByTerm(Request $request){
        $tasks = Task::with("category","user")
            ->where('title','like','%'.$request->query('term').'%')
            ->orWhere('body','like','%'.$request->query('term').'%')
            ->orWhere('id','like','%'.$request->query('term').'%')
            ->paginate(5);

        $categories = Category::has('tasks')->get();
        return Inertia::render('Tasks/Index',[
            'tasks' => $tasks,
            'categories' => $categories,
        ]);
    }
}
