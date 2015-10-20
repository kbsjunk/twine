<?php

namespace Twine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use SoftDeletes;
	
	protected $fillable = [
		'name',
		'format',
		'url',
	];
	
	public function projects()
	{
		return $this->hasMany('Twine\Project');
	}
}
