<?php

namespace Twine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
	
	protected $fillable = [
		'name',
		'branch',
		'format',
		'url',
		'repository_id',
	];
	
	public function sources()
	{
		return $this->hasMany('Twine\Source');
	}

	public function getNameBranchAttribute()
	{
		return "{$this->name}.{$this->branch}";
	}
}
