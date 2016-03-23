<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('tasks.all');
	}

	/**
	 * Returns the list of tasks pending.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function pending() {
		return Task::pendingTasks();
	}

	/**
	 * Returns the list of tasks completed.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function completed() {
		return Task::completedTasks();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$task = Task::create([
			'user_id' => Auth::user()->id,
			'title' => $request->input('title'),
			'status' => 0,
		]);

		return Task::pendingTasks();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$task = Task::find($id);

		if (count($task)) {
			$task->status = $request->input('status');
			$task->save();

			return response()->json(['status' => true]);
		}

		return response()->json(['status' => false]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
