<?php 
namespace App\Repositories;

use Exception;
use Carbon\Carbon;

use App\Task;
use App\User;

class TaskRepository {
	public function findById($task_id) {
		return Task::findOrFail($task_id);
	}

	public function findAll() {
		return Task::all();
	}

	public function findByUserId($user_id) {
		$tasks = User::find($user_id)->tasks;

		if($tasks) {
			return $tasks;
		} else {
			throw new Exception("No tasks found", 1);
		}
	}

	public function findFiltered($user_id, $filter) {
		$tasks = User::find($user_id)->tasks->where('is_completed', '=', $filter);

		if($tasks) {
			return $tasks;
		} else {
			throw new Exception("No tasks found", 1);
		}
	}

	public function store($user_id, $data) {
		$data['user_id'] = $user_id;
		return Task::create($data);
	}

	public function update($user_id, $task_id, $data) {
		$task = Task::find($task_id);

		if($data['is_completed'] == 1)
			$data['completed_at'] = Carbon::now();

		$this->authorize($user_id, $task->user_id);

		$task->fill($data);
		$task->save();

		return $task;
	}

	public function destroy($user_id, $task_id) {
		$task = $this->findById($task_id);

		$this->authorize($user_id, $task->user_id);

		$delete = $task->delete();

		if($delete) {
			return ['deleted' => true];
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function authorize($user_id, $task_user_id) {
		if($user_id == $task_user_id) {
			return true;
		} else {
			throw new Exception("You can't do this.", 1);
		}
	}
}