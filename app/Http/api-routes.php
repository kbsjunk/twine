<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

	$api->group(['namespace' => 'Twine\Http\Controllers\Api\V1'], function ($api) {

		$api->group(['prefix' => 'strings'], function ($api) {

			$api->get('/', 'StringsController@index');
			$api->get('{id}', 'StringsController@show');

		});
	});

});