<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use HasFactory, Notifiable, HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'stage_name',
		'api_token',
		'birthdate'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'birthdate' => 'datetime',
	];

	/**
	 * Get current user age
	 */
	public function getAgeAttribute()
	{
		return $this->birthdate->age;
	}

	/**
	 * Get ranking position
	 * 
	 * @return integer
	 */
	public function getPositionAttribute()
	{
		$collection = collect(User::orderBy('score', 'DESC')->get());
		$data = $collection->where('id', $this->id);

		return $data->keys()->first() + 1;
	}

	/**
	 * Get events in which the user is participating.
	 */
	public function rankings()
	{
		return $this->hasMany(Ranking::class);
	}
}
