<?php

namespace Twine\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Twine\Http\Requests;
use Twine\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

use Twine\String;
use Twine\Transformers\StringTransformer;

class StringsController extends Controller
{
	use Helpers;

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$strings = String::paginate(5);

		return $this->response->paginator($strings, new StringTransformer);
	}

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create()
	{
		//
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
	{
		//
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$string = String::findHashidOrFail($id);

		if (count($string) > 1) {
			return $this->response->collection($string, new StringTransformer);
		}
		
		return $this->response->item($string, new StringTransformer);
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit($id)
	{
		//
	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id)
	{
		//
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
	{
		//
	}
}
