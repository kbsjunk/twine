<?php

namespace Twine;

class String extends AbstractModel
{
	
	protected $casts = [
		'placeholders' => 'json',
	];
	
	protected $fillable = [
		'locale',
		'uri',
		'key',
		'value',
		'plural',
		'placeholders',
		'source_id',
	];
	
    public function source()
	{
		return $this->belongsTo('Twine\Source');
	}

	// public function setUriAttribute($uri)
	// {
	// 	$this->attributes['uri'] = self::makeUri($uri);
	// }

	// public function getUriAttribute()
	// {
	// 	$uri = explode('.', $getAttributeFromArray('uri'));

	// 	$uri = array_map(function($i) {
	// 		return str_replace('\¤', '.', $i);
	// 	}, $uri);

	// 	return $uri;
	// }

	// public function getUriRawAttribute()
	// {
	// 	return $this->getAttributeFromArray('uri');
	// }

	public static function makeUri($uri)
	{
		$uri = (array) $uri;

		$uri = array_map(function($i) {
			return str_replace('.', '\¤', $i);
		}, $uri);

		return implode('.', $uri);
	}

}
