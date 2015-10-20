<?php

namespace Twine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids;
use Auth;

abstract class AbstractModel extends Model
{
    use SoftDeletes;
	
	public function getHashidAttribute()
	{
		return Hashids::encode($this->id);
	}
	
	public function scopeFindHashidOrFail($query, $hashid)
	{
		$id = Hashids::decode($hashid);
		
		if (count($id) == 1) $id = head($id);
				
		return $query->findOrFail($id);
	}
	
	public function scopeFindHashid($query, $hashid)
	{
		$id = Hashids::decode($hashid);
				
		return $query->find($id);
	}
	
    public function createdBy()
	{
		return $this->belongsTo('Twine\User', 'created_by');
	}
	
/* 	public function getHashidAttribute()
	{
		return Hashids::encode($this->id, Auth::user()->id);
	}
	
	public function scopeFindHashidOrFail($query, $hashid)
	{
		$hashid = Hashids::decode($hashid);
		
		$id = head($hashid);
		$user_id = last($hashid) == Auth::user()->id ? $id : null;
		
		return $query->where('id', $id)->findOrFail($id);
	} */
}
