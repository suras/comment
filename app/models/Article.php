<?php

class Article extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'body' => 'required'
	);

	 public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

      public function endorsements()
    {
        return $this->hasMany('Endorsement');
    }
}
