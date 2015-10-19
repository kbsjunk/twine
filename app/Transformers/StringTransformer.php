<?php

namespace Twine\Transformers;

use Twine\String;
use League\Fractal\TransformerAbstract;

class StringTransformer extends TransformerAbstract
{
	public function transform(String $string)
	{
	    return [
	        'id'     => $string->hashid,
	        'locale' => $string->locale,
	        'key'    => $string->key,
	        'value'  => $string->value,
            'links'  => [
                [
                    'rel' => 'self',
                    'uri' => '/strings/'.$string->hashid,
                ]
            ],
	    ];
	}
}