<?php

class Comment extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'message' => 'required|max:250',
		'article_id' => 'required'
	);

	public function article()
    {
        return $this->belongsTo('Article');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}
