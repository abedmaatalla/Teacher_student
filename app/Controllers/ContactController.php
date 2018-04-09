<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Contact;
/**
 * summary
 */
class ContactController extends Controller
{
    /**
     * summary
     */

    public function updateContact($req, $res)
    {

        $user =  $this->auth->user();
        
        
        $contact = Contact::where('id_user', $user->id)->first();

        if(!$contact){
            $contact = Contact::create([
                'phone' => '',
                'skype' => '',
                'facebook' => '',
                'twitter' => '',
                'linkedin' => '',
                'id_user' => $user->id,
                'created_at' => date("Y-m-d H:i:s"),
                ]);
        }
        $contact->phone = $req->getParam("phone");
        $contact->skype = $req->getParam("skype");
        $contact->facebook = $req->getParam("facebook");
        $contact->twitter = $req->getParam("twitter");
        $contact->linkedin = $req->getParam("linkedin");
        
        $contact->save();

        $this->flash->addMessage('messageSuccess', 'Successfuly updated');
        return $res->withRedirect($this->router->pathFor('profile'));
    }
}