<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * summary
 */
class Doc extends Model
{
    /**
     * summary
     */
    
    protected $table = 'docs'; // this is optional only if the model's name is not singlar of table's name

    protected $fillable = [
        'name',
        'url',
        'extension',
        'id_user',
    ]; // this is nessacery to fill the table 
}
