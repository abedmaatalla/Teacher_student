<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Doc;
/**
 * summary
 */
class DocController extends Controller
{
    /**
     * summary
     */

    public function index($req, $res)
    {
    	return $this->view->render($res, 'admin/index.twig');
    }

    public function student($req, $res)
    {
        
        $users = User::where('type', 'student')->orderBy('active')->get();
        
        return $this->view->render($res, 'admin/index.twig',
            [
                'users'=>$users,
                'lang' => $this->translator->getLocale(),
            ]
        );
    }


    public function teacher($req, $res)
    {

        
        $users = User::where('type','techer')->orderBy('active')->get();

        return $this->view->render($res, 'admin/index.twig',
            [
                'users'=>$users,
                'lang' => $this->translator->getLocale(),
            ]
        );
    }
}