<?php 


namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;
use App\Models\Doc;
/**
 * summary
 */
class UploadController extends Controller
{
	public function deleteFile($req, $res)
	{
		$doc = Doc::where('id_user', $this->auth->user()->id)->first();

        if(!$doc){
	        $this->flash->addMessage('messageDanger', "Don't have resume");
	        return $res->withRedirect($this->router->pathFor('profile'));
        }
        unlink("/upload/".$doc->name);
		$doc->delete();
        $this->flash->addMessage('messageSuccess', "Successfuly Deleted");
        return $res->withRedirect($this->router->pathFor('profile'));
        
	}

    public function upload($req, $res)
    {
        $docExtensions = array('pdf','doc','png','jpg','jpeg');
        $imageExtensions = array('png','jpg','jpeg');

        if($req->getParam('type') == 'document'){
            $files = $req->getUploadedFiles();
            if (empty($files['file'])) {
                return 'false';
            }

            date_default_timezone_set('America/Los_Angeles');

            $newfile = $files['file'];
            // do something with $newfile
            if ($files['file']->getError() === UPLOAD_ERR_OK) {
                $uploadFileName = $newfile->getClientFilename();
                $extension = pathinfo($uploadFileName,PATHINFO_EXTENSION);
                if(!in_array($extension, $docExtensions)) {
                    $this->flash->addMessage('messageDanger', 'Upload Failed');
                    return false;
                }
                $uploadFileName = md5(date('Y-m-d H:i:s:u')).'.'.$extension;
                $path = '/upload/'.$uploadFileName;

                $newfile->moveTo($path);
            
                $this->flash->addMessage('messageSuccess', 'Successfuly Uploaded');

                $user =  $this->auth->user();
        
                $doc = Doc::where('id_user', $user->id)->first();

                if(!$doc){
                    $doc = Doc::create([
                    'name' => $uploadFileName,
                    'url' => $this->container['config']->get('url').$path,
                    'id_user' => $this->auth->user()->id,
                    'extension' => 'pdf',
                    'created_at' => date("Y-m-d H:i:s"),
                    ]);
                }
                $doc->name = $uploadFileName;
                $doc->url = $this->container['config']->get('url').$path;
                $doc->extension = $extension;

                $doc->save();
            }
        }else

            if($req->getParam('type') == 'profileImage'){
                $files = $req->getUploadedFiles();

                if (empty($files['file'])) {
                    return 'false';
                }

                $newfile = $files['file'];
                // do something with $newfile
                if ($files['file']->getError() === UPLOAD_ERR_OK) {
                    $uploadFileName = $newfile->getClientFilename();
                    $extension = pathinfo($uploadFileName,PATHINFO_EXTENSION);

                    if(!in_array($extension, $imageExtensions)) {
                        $this->flash->addMessage('messageDanger', 'Upload Failed');
                        return false;
                    }

                    $uploadFileName = md5(date('Y-m-d H:i:s:u')).'.'.$extension;
                    $path = '/upload/'.$uploadFileName;


                    $newfile->moveTo($path);
                
                    $this->flash->addMessage('messageSuccess', 'Successfuly Uploaded');
                    $user = $this->auth->user();

                    $oldFile = $user->image;

                    $user->image = $this->container['config']->get('url').$path;
                    $user->save();

                    unlink(substr($oldFile, strpos($oldFile,"/upload/")));
                }
            }else

                $this->flash->addMessage('messageDanger', 'Upload Failed');

    }

}