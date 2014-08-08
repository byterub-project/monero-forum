<?php

class Thread extends \Eloquent {
	protected $fillable = [];
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function forum() {
		return $this->belongsTo('Forum');
	}
	
	public function posts() {
		return $this->hasMany('Post');
	}
	
	public function head() {
		return Post::find($this->post_id);
	}
	
	public function slug() {
		$slug = $this->name;	
		
		$slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);
		$slug = trim($slug, '-');
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
		$slug = strtolower($slug);
		$slug = preg_replace('~[^-\w]+~', '', $slug);
			
		if (empty($slug)) {
	    	return 'n-a';
		}
			
		return $slug;
	}
	
	public function permalink() {
		return "http://".$_SERVER['HTTP_HOST']."/".$this->forum->slug()."/".$this->forum->id."/".$this->slug()."/".$this->id;
	}
}