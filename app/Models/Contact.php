<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * summary
 */
class Contact extends Model
{
    /**
     * summary
     */
    
    protected $table = 'contacts'; // this is optional only if the model's name is not singlar of table's name

    protected $fillable = [
        'phone',
        'skype',
        'facebook',
        'twitter',
        'linkedin',
        'id_user',
    ]; // this is nessacery to fill the table 
}
