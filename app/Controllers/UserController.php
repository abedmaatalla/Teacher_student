<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Doc;
/**
 * summary
 */
class UserController extends Controller
{
    /**
     * summary
     */
    

    public function teacherUpdate($req, $res)
    {

        $user = $this->auth->user();
        
    	if($user->password != $req->getParam('password')){
	        $this->flash->addMessage('messageDanger', 'Failed to update');
	        return $res->withRedirect($this->router->pathFor('profile'));
    	}

        $user->firstName = $req->getParam("firstName");
        $user->lastName = $req->getParam("lastName");
        $user->sexe = $req->getParam("sexe");
        $user->age = $req->getParam("age");
        $user->country = $req->getParam("country");
        $user->language = $req->getParam("language");
        $user->experience = $req->getParam("experience");
        $user->price = $req->getParam("price");
        $user->bio = $req->getParam("bio");

        $user->save();

        $this->flash->addMessage('messageSuccess', 'Successfuly updated');
        return $res->withRedirect($this->router->pathFor('profile'));
    }

    public function studentUpdate($req, $res)
    {
    	$user = $this->auth->user();
        
    	if($user->password != $req->getParam('password')){
	        $this->flash->addMessage('messageDanger', 'Failed to update');
	        return $res->withRedirect($this->router->pathFor('profile'));
    	}

        
        $user->firstName = $req->getParam("firstName");
        $user->lastName = $req->getParam("lastName");
        $user->sexe = $req->getParam("sexe");
        $user->age = $req->getParam("age");
        $user->country = $req->getParam("country");
        $user->language = $req->getParam("language");
        $user->experience = $req->getParam("experience");
        $user->price = $req->getParam("price");
        $user->bio = $req->getParam("bio");

        $user->save();

        $this->flash->addMessage('messageSuccess', 'Successfuly updated');
        return $res->withRedirect($this->router->pathFor('profile'));
    }

}