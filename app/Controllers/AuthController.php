<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Contact;
use App\Models\Doc;
use Nette\Mail\Message;
use Rych\Random\Random;
use App\mail\MailHelper;
use App\Models\Category;
/**
 * summary
 */
class AuthController extends Controller
{
    /**
     * summary
     */

    public function login($req, $res)
    {
        $auth = $this->auth->attempt(
            $req->getParam('email'),
            $req->getParam('password')
        );

        if(!$auth){
            $this->flash->addMessage('messageDanger', 'Authantication Failed');
            return $res->withRedirect($this->router->pathFor('home'));
        }

        $this->flash->addMessage('messageSuccess', 'Authanticate Successfuly');
        return $res->withRedirect($this->router->pathFor('home'));
    }

    public function logOut($req, $res)
    {   
        unset($_SESSION["user"]);
        return $res->withRedirect($this->router->pathFor('home'));   
    }

    public function profile($req, $res)
    {
        if(!$this->auth->check())
            return $res->withRedirect($this->router->pathFor('home'));

        $user = $this->auth->user();
        $contact = Contact::where('id_user', $user->id)->first();
        $doc = Doc::where('id_user', $user->id)->first();

        if($user->type == 'admin')
            return $res->withRedirect($this->router->pathFor('admin'));   

        return $this->view->render($res, $user->type.'/profile.twig',
            [
                'user'=>$user,
                'contact'=>$contact,
                'doc'=>$doc,
                'categoryList' => Category::allInfoMainCategoryFirst(),
                'messageSuccess' => ["messageSuccess" => $this->flash->getMessage('messageSuccess')[0]],
                'messageDanger' => ["messageDanger" => $this->flash->getMessage('messageDanger')[0]],
                'lang' => $this->translator->getLocale(),
            ]
        );
    }

    public function checkPermission($req, $res)
    {
        return $res->withRedirect($this->router->pathFor('home'));
    }

    public function teacherSignUp($req, $res)
    {

        if(!is_numeric($req->getParam('age')) || !is_numeric($req->getParam('price'))){
            $this->flash->addMessage('messageDanger', 'Failed to create your account');
            return $res->withRedirect($this->router->pathFor('home'));
        }

        $user = User::where("email", $req->getParam('email'))->first();
        if(!empty($user)){
            $this->flash->addMessage('messageDanger', 'Failed, email does not exist');
            return $res->withRedirect($this->router->pathFor('home'));
        }

        User::create([
            'firstName' => $req->getParam('firstName'),
            'lastName' => $req->getParam('lastName'),
            'image' => $this->container['config']->get('url').'/assets/img/profile.png',
            'sexe' => $req->getParam('sexe'),
            'age' => $req->getParam('age'),
            'country' => $req->getParam('country'),
            'address' => $req->getParam('address'),
            'language' => $req->getParam('language'),
            'experience' => $req->getParam('experience'),
            'price' => $req->getParam('price'),
            'email' => $req->getParam('email'),
            'password' => $req->getParam('password'),
            'bio' => $req->getParam('bio'),
            'type' => "teacher",
            'active' => false,
            'created_at' => date("Y-m-d H:i:s"),
            ]);


            $mailHelper = new MailHelper($req->getParam('email'), 'Teacher Account', "Welcome to TurEdu \n Your Account has been created Successfuly");
            $mailHelper->send();
        
        $this->flash->addMessage('messageSuccess', 'Successfuly create your account');

        return $res->withRedirect($this->router->pathFor('home'));
    }

    public function studentSignUp($req, $res)
    {
        if(!is_numeric($req->getParam('age')) || !is_numeric($req->getParam('price'))){
            $this->flash->addMessage('messageDanger', 'Failed to create your account');
            return $res->withRedirect($this->router->pathFor('home'));
        }

        $user = User::where("email", $req->getParam('email'))->first();
        if(!empty($user)){
            $this->flash->addMessage('messageDanger', 'Failed, email does not exist');
            return $res->withRedirect($this->router->pathFor('home'));
        }

        User::create([
            'firstName' => $req->getParam('firstName'),
            'lastName' => $req->getParam('lastName'),
            'image' => $this->container['config']->get('url').'/assets/img/profile.png',
            'sexe' => $req->getParam('sexe'),
            'age' => $req->getParam('age'),
            'country' => $req->getParam('country'),
            'address' => $req->getParam('address'),
            'language' => $req->getParam('language'),
            'experience' => $req->getParam('experience'),
            'price' => $req->getParam('price'),
            'email' => $req->getParam('email'),
            'password' => $req->getParam('password'),
            'bio' => $req->getParam('bio'),
            'type' => "student",
            'active' => false,
            ]);


            $mailHelper = new MailHelper($req->getParam('email'), 'Student Account', "Welcome to TurEdu \n Your Account has been created Successfuly");
            $mailHelper->send();


        $this->flash->addMessage('messageSuccess', 'Successfuly create your account');
        return $res->withRedirect($this->router->pathFor('home'));
    }

    public function forgetPassword($req, $res)
    {
        if(!$this->auth->check())
            return $res->withRedirect($this->router->pathFor('home'));

        return $this->view->render($res, 'auth/forgetPassword.twig', [
            'lang' => $this->translator->getLocale(),
            ]);
    }

    public function resetPassword($req, $res)
    {
        $random = new Random;
        $randomPassword = $random->getRandomString(8);

        $user = User::where("email", $req->getParam('email'))->first();
        if(!empty($user)){
            $user->password = $randomPassword;
            $user->save();

            $mailHelper = new MailHelper($req->getParam('email'), 'Reset Password', "Your new Password is: ".$randomPassword);
            $mailHelper->send();

            $this->flash->addMessage('messageSuccess', 'Successfuly, check your Email');
        }else{
            $this->flash->addMessage('messageDanger', 'Failed, email does not exist');
        }

        return $res->withRedirect($this->router->pathFor('home'));
    }
}