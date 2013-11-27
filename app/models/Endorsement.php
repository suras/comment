<?php

class Endorsement extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'article_id' => 'required'
	);
}
