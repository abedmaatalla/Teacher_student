<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Category;
/**
 * summary
 */
class CategoryController extends Controller
{
    /**
     * summary
     */

    public function index($req, $res)
    {
        $array = [
            'lang' => $this->translator->getLocale(),
            'categoryList' => Category::allInfo(),
            'mainCategoryList' => Category::allInfoMain(),
            ];

    	return $this->view->render($res, 'admin/categories.twig', $array);
    }

    public function mainIndex($req, $res)
    {
        $array = [
            'lang' => $this->translator->getLocale(),
            'categoryList' => Category::allInfo(),
            'mainCategoryList' => Category::allInfoMain(),
            ];

        return $this->view->render($res, 'admin/mainCategories.twig', $array);
    }


    public function add($req, $res)
    {
        $category = new Category();
        $category->code = $req->getParam('code');
        $category->category = $req->getParam('category');

        $category->save();

        return $res->withRedirect($this->router->pathFor('category'));
    }

    public function addMain($req, $res)
    {
        $category = new Category();
        $category->code = 0;
        $category->category = $req->getParam('category');

        $category->save();

        return $res->withRedirect($this->router->pathFor('category'));
    }

    public function edit($req, $res)
    {
        $id = $req->getAttribute('id');
        $category = Category::find($id);

        $category->code = $req->getParam('code');
        $category->category = $req->getParam('category');

        $category->save();

        return $res->withRedirect($this->router->pathFor('category'));
    }

    public function delete($req, $res)
    {
        $id = $req->getAttribute('id');

        $category = Category::find($id);

        $category->delete();

        return $res->withRedirect($this->router->pathFor('category'));
    }

    public function deleteMain($req, $res)
    {
        $id = $req->getAttribute('id');

        $category = Category::find($id);

        $subCategories = Category::where("code", $id)->get();

        foreach ($subCategories as $cat) {
            $cat->delete();
        }

        $category->delete();

        return $res->withRedirect($this->router->pathFor('mainCategory'));
    }
}