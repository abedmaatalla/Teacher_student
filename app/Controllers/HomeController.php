<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Category;

/**
 * summary
 */
class HomeController extends Controller
{
    /**
     * summary
     */

    public function index($req, $res)
    {
    	$teachers = User::where("type", "teacher")->where("active",1)->orderBy('created_at')->take(10)->get();
    	$students = User::where("type", "student")->where("active",1)->orderBy('created_at')->take(10)->get();
    	return $this->view->render($res, 'index.twig', [
    		'teachers' => $teachers,
    		'students' => $students,
            'visitor' => $this->visitor,
            'categoryList' => Category::allInfoMainCategoryFirst(),
            'messageSuccess' => ["messageSuccess" => $this->flash->getMessage('messageSuccess')[0]],
            'messageDanger' => ["messageDanger" => $this->flash->getMessage('messageDanger')[0]],
            'lang' => $this->translator->getLocale(),
    		]);
    }

    public function allStudents($req, $res)
    {
        $students = User::where("type", "student")->where("active",1)->orderBy('created_at')->take(50)->get();
        
        return $this->view->render($res, 'allStudents.twig', [
            'users' => $students,
            'visitor' => $this->visitor,
            'lang' => $this->translator->getLocale(),
            ]);
    }
    public function allTeachers($req, $res)
    {
        $teachers = User::where("type", "teacher")->where("active",1)->orderBy('created_at')->take(50)->get();
        return $this->view->render($res, 'allTeachers.twig', [
            'users' => $teachers,
            'visitor' => $this->visitor,
            'lang' => $this->translator->getLocale(),
            ]);
    }

    public function searchStudents($req, $res)
    {
        return $this->view->render($res, 'search.twig', [
            'users' => $users,
            'visitor' => $this->visitor,
            'lang' => $this->translator->getLocale(),
            ]);
    }
    public function searchTeachers($req, $res)
    {
        
        return $this->view->render($res, 'search.twig', [
            'users' => $users,
            'visitor' => $this->visitor,
            'lang' => $this->translator->getLocale(),
            ]);
    }
}