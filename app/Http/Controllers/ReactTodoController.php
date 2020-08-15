<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Libs\AppConst;
use App\Todo;
//
class ReactTodoController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {
//exit();
        return view('react/todos/index')->with('todos', null );
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('react/todos/create')->with('todo', new Todo());
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $task_id  = $id;
        return view('react/todos/edit')->with(compact('task_id' ) );
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
		$task_id  = $id;
		return view('react/todos/show')->with(compact('task_id' ) );        
    }     

}
