<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {

	use SoftDeletes;
	/**
	 * The attributes that can be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'title', 'description', 'status'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * User - Task table relationship.
	 * This function returns list of tasks for the user
	 * @return array
	 */
	public function users() {
		return $this->belongsTo(\App\User::class, 'user_id');
	}

	public static function pendingTasks() {
		return self::where('status', 0)->orderBy('updated_at', 'ASC')->get();
	}

	public static function completedTasks() {
		return self::where('status', 1)->orderBy('updated_at', 'ASC')->get();
	}
}
