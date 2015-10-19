<?php

namespace Twine;

class String extends AbstractModel
{
	
	protected $casts = [
		'value' => 'json',	
	];
	
	protected $fillable = [
		'locale',
		'resource',
		'key',
		'value',
		'type',
		'source_id',
	];
	
    public function source()
	{
		return $this->belongsTo('Twine\Source');
	}
}
