<?php

class Comment extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'message' => 'required',
		'flag' => 'required'
	);
}
