<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	protected $table = 'users';
	protected $fillable = ['name', 'email', 'password'];
	protected $hidden = ['password', 'remember_token'];


	public function getCreatedAtAttribute($value)
	{
		return date('d-m-y g:m:s a',strtotime($value));
	}
	public function getUpdatedAtAttribute($value)
	{
		return date('d-m-y g:m:s a',strtotime($value));
	}

	//relation
	public function cases()
	{
		return $this->hasMany('App\CaseModel');
	}
}