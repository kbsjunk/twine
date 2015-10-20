<?php

namespace Twine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;
	
	protected $fillable = [
		'locale',
		'format',
		'url',
		'path',
		'project_id',
	];
	
	public function strings()
	{
		return $this->hasMany('Twine\String');
	}
}
