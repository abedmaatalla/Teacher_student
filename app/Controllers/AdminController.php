<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
/**
 * summary
 */
class AdminController extends Controller
{
    /**
     * summary
     */

    public function index($req, $res)
    {
        $activeStudents = User::where('type', 'student')->where('active',1)->get();
        $noActiveStudents = User::where('type', 'student')->where('active',0)->get();
        $activeTeachers = User::where('type', 'teacher')->where('active',1)->get();
        $noActiveTeachers = User::where('type', 'teacher')->where('active',0)->get();

        return $this->view->render($res, 'admin/index.twig',[
            'messageSuccess' => ["messageSuccess" => $this->flash->getMessage('messageSuccess')[0]],
            'messageDanger' => ["messageDanger" => $this->flash->getMessage('messageDanger')[0]],
            'activeStudents' => count($activeStudents),
            'noActiveStudents' => count($noActiveStudents),
            'activeTeachers' => count($activeTeachers),
            'noActiveTeachers' => count($noActiveTeachers),
            'lang' => $this->translator->getLocale(),
            ]);
    }
    public function profile($req, $res)
    {
        return $this->view->render($res, 'admin/profile.twig',[
            'messageSuccess' => ["messageSuccess" => $this->flash->getMessage('messageSuccess')[0]],
            'messageDanger' => ["messageDanger" => $this->flash->getMessage('messageDanger')[0]],
            'lang' => $this->translator->getLocale(),
            ]);
    }

    public function profileEdit($req, $res)
    {
        $user = $this->auth->user();
        
        if($user->password != $req->getParam('password')){
            $this->flash->addMessage('messageDanger', 'Failed to update');
            return $res->withRedirect($this->router->pathFor('adminProfile'));
        }

        $user->firstName = $req->getParam("firstName");
        $user->lastName = $req->getParam("lastName");

        $user->save();

        $this->flash->addMessage('messageSuccess', 'Successfuly updated');
        return $res->withRedirect($this->router->pathFor('adminProfile'));
    }

    public function editUser($req, $res)
    {
        if(!is_numeric(trim($req->getParam('id')))){
            $this->flash->addMessage('messageDanger', 'Failed to update');
            return $res->withRedirect($this->router->pathFor('admin'));
        }

        $user = User::find(trim($req->getParam('id')));

        if($user->active != $req->getParam("active")){
            $mailHelper = new MailHelper($req->getParam('email'), 'Account Activation', "Welcome to TurEdu \n Your Account has been activated Successfuly");
            $mailHelper->send();
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
        $user->active = $req->getParam("active");

        $user->save();

        $this->flash->addMessage('messageSuccess', 'Successfuly updated');
        return $res->withRedirect($this->router->pathFor('admin'));
    }

    public function activeStudent($req, $res)
    {
        $users = User::where('type', 'student')->where('active',1)->get();
        
        return $this->view->render($res, 'admin/userList.twig',
            [
                'users'=>$users,
                'title'=>"Students",
                'lang' => $this->translator->getLocale(),
            ]
        );
    }

    public function noActiveStudent($req, $res)
    {
        $users = User::where('type', 'student')->where('active',0)->get();
        
        return $this->view->render($res, 'admin/userList.twig',
            [
                'users'=>$users,
                'title'=>"Students",
                'lang' => $this->translator->getLocale(),
            ]
        );
    }


    public function activeTeacher($req, $res)
    {
        $users = User::where('type','teacher')->where('active',1)->get();

        return $this->view->render($res, 'admin/userList.twig',
            [
                'users'=>$users,
                'title'=>"Teachers",
                'lang' => $this->translator->getLocale(),
            ]
        );
    }

    public function noActiveTeacher($req, $res)
    {
        $users = User::where('type','teacher')->where('active',0)->get();

        return $this->view->render($res, 'admin/userList.twig',
            [
                'users'=>$users,
                'title'=>"Teachers",
                'lang' => $this->translator->getLocale(),
            ]
        );
    }
}