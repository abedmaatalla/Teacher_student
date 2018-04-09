<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

/**
 * summary
 */
class SearchController extends Controller
{
    /**
     * summary
     */

    public function search($req, $res)
    {
      if($req->getParam("userType") == "student"){

        $users = User::where('type', $req->getParam("userType"))
              ->where("active", 1);


        if(!empty($req->getParam("country")))
          $users = $users->where('country', $req->getParam("country"));
          

        if(!empty($req->getParam("category")))
          $users = $users->where('id_category', $req->getParam("category"));

        if(!empty($req->getParam("experience")))
          $users = $users->where('experience', $req->getParam("experience"));

        if(!empty($req->getParam("name")))
            $users = $users->where(function ($query) use ($req){
                $query->where('firstName','like', '%'.$req->getParam("name").'%')
                      ->orWhere('lastName' ,'like', '%'.$req->getParam("name").'%');
            });

        if(!empty($req->getParam("ageMin")) && !empty($req->getParam("ageMax"))){
            $users = $users->whereBetween('age', [$req->getParam("ageMin"),$req->getParam("ageMax")]);
        }else{
          if(!empty($req->getParam("ageMin")))
              $users = $users->where('age', '>', $req->getParam("ageMin"));

          if(!empty($req->getParam("ageMax")))
              $users = $users->where('age', '<', $req->getParam("ageMax"));
        }

        if(!empty($req->getParam("priceMin")) && !empty($req->getParam("priceMax"))){
            $users = $users->whereBetween('price', [$req->getParam("priceMin"), $req->getParam("priceMax")]);
        }else{
          if(!empty($req->getParam("priceMin")))
              $users = $users->where('price', '>', $req->getParam("priceMin"));

          if(!empty($req->getParam("priceMax")))
              $users = $users->where('price', '<', $req->getParam("priceMax"));
        }


        $users = $users->get();

      }else {

        $users = User::where('type', $req->getParam("userType"))
              ->where("active", 1);

        if(!empty($req->getParam("country")))
          $users = $users->where('country', $req->getParam("country"));
          

        if(!empty($req->getParam("category")))
          $users = $users->where('id_category', $req->getParam("category"));

        if(!empty($req->getParam("sexe")))
          $users = $users->where('sexe', $req->getParam("sexe"));

        if(!empty($req->getParam("name")))
            $users = $users->where(function ($query) use ($req){
                $query->where('firstName','like', '%'.$req->getParam("name").'%')
                      ->orWhere('lastName' ,'like', '%'.$req->getParam("name").'%');
            });

        if(!empty($req->getParam("ageMin")) && !empty($req->getParam("ageMax"))){
            $users = $users->whereBetween('age', [$req->getParam("ageMin"),$req->getParam("ageMax")]);
        }else{
          if(!empty($req->getParam("ageMin")))
              $users = $users->where('age', '>', $req->getParam("ageMin"));

          if(!empty($req->getParam("ageMax")))
              $users = $users->where('age', '<', $req->getParam("ageMax"));
        }

        if(!empty($req->getParam("priceMin")) && !empty($req->getParam("priceMax"))){
            $users = $users->whereBetween('price', [$req->getParam("priceMin"), $req->getParam("priceMax")]);
        }else{
          if(!empty($req->getParam("priceMin")))
              $users = $users->where('price', '>', $req->getParam("priceMin"));

          if(!empty($req->getParam("priceMax")))
              $users = $users->where('price', '<', $req->getParam("priceMax"));
        }

        if(!empty($req->getParam("experienceMin")) && !empty($req->getParam("experienceMax")))
            $users = $users->whereBetween('experience', [$req->getParam("experienceMin"),$req->getParam("experienceMax")]);

        
        $users = $users->get();
      }
      
      return $this->view->render($res, 'search.twig',[
          'results' => $users,
          'categoryList' => Category::allInfoMainCategoryFirst(),
          'messageSuccess' => ["messageSuccess" => $this->flash->getMessage('messageSuccess')[0]],
          'messageDanger' => ["messageDanger" => $this->flash->getMessage('messageDanger')[0]],
          'lang' => $this->translator->getLocale(),
          ]);
        
    }
}