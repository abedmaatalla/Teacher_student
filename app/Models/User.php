<?php 

namespace App\Models;

use App\Models\Doc;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
/**
 * summary
 */
class User extends Model
{
    /**
     * summary
     */
    
    protected $table = 'users'; // this is optional only if the model's name is not singlar of table's name

    protected $fillable = [
    	'firstName',
        'lastName',
        'image',
        'sexe',
        'country',
        'age',
        'address',
        'language',
        'experience',
        'price',
    	'email',
        'password',
        'bio',
        'type',
        'active',
    ]; // this is nessacery to fill the table 

    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstName'] = ucfirst($value);
    }

    public function resume()
    {   
        $doc = Doc::where('id_user', $this->id)->first();
        if(!$doc)
            return '#';
        return $doc->url;
    }

    public function contact()
    {   
        $contct = Contact::where('id_user', $this->id)->first();
        if(!$contct)
            return '#';
        return $contct;
    }
}
