<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * summary
 */
class Category extends Model
{
    /**
     * summary
     */
    
    protected $table = 'category'; // this is optional only if the model's name is not singlar of table's name

    protected $fillable = [
        'code', // to tell if it's a category or a sub category
        // if category code == 0
        'category',
    ]; // this is nessacery to fill the table 

    public static function allInfo()
    {
        $categories = Category::where("code","!=", "0")->get();

        foreach ($categories as $category) {
            $category->mainCategory = Category::find($category->code);
        }

        return $categories;
    }

    public static function allInfoMainCategoryFirst()
    {
        $categories = Category::where("code","=", "0")->get();

        foreach ($categories as $category) {
            $category->subCategory = Category::where("code", $category->id)->where('code' ,'!=', "0")->get();
        }

        return $categories;
    }

    public static function allInfoMain()
    {
    	$categories = Category::where("code","=", "0")->get();	
    	return $categories;
    }
}
