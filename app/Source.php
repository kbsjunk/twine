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
		'path',
	];
	
	public function strings()
	{
		return $this->hasMany('Twine\String');
	}
}
