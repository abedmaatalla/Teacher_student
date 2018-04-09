<?php 


namespace App\Auth;

use Slim\Views\Twig as View;
use App\Models\User;
/**
 * summary
 */
class Auth
{

	public function user()
	{
		if(!$this->check())
			return false;
		return User::find($_SESSION['user']);
	}

	public function check()
	{
		if(isset($_SESSION["user"])){
			$user = User::find($_SESSION['user']);
			if(empty($user))
				return false;
			return true;
		}
		return false;
	}

	public function isAdmin()
	{
		if($this->check())
			return $this->user()->type == "admin";
		return false;
	}

	public function isStudent()
	{	if($this->check())	
			return $this->user()->type == "student";
		return false;
	}

	public function isTeacher()
	{	if($this->check())
			return $this->user()->type == "teacher";
		return false;
	}

	public function attempt($email, $password)
	{
		$user = User::where('email', $email)->first();

		if(!$user)
			return false;

		if($user->password == $password){

			$_SESSION["user"] = $user->id;

			return true;
		}
		return false;
	}
	
}