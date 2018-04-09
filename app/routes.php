<?php 

$app->get('/', "HomeController:index")->setName('home');

$app->get('/forgetPassword', "AuthController:forgetPassword")->setName("forgetPassword");

$app->post('/resetPassword', "AuthController:resetPassword")->setName("resetPassword");

if($container->auth->isAdmin()){
	$app->get('/admin', "AdminController:index")->setName('admin');
	
	$app->post('/admin/edit', "AdminController:editUser")->setName('editUser');

	$app->get('/admin/activeStudent', "AdminController:activeStudent")->setName('activeStudent');
	$app->get('/admin/noActiveStudent', "AdminController:noActiveStudent")->setName('noActiveStudent');
	$app->get('/admin/activeTeacher', "AdminController:activeTeacher")->setName('activeTeacher');
	$app->get('/admin/noActiveTeacher', "AdminController:noActiveTeacher")->setName('noActiveTeacher');

	$app->get('/admin/profile', "AdminController:profile")->setName('adminProfile');
	$app->post('/admin/profile/edit', "AdminController:profileEdit")->setName('adminProfileEdit');

	$app->get('/admin/Categories', "CategoryController:index")->setName('category');
	$app->post('/admin/Categort/Add', "CategoryController:add")->setName('addCategory');
	$app->post('/admin/Categort/addMain', "CategoryController:addMain")->setName('addMainCategory');
	
	$app->get('/admin/Categort/delete/{id}', "CategoryController:delete")->setName('removeCategory');
	$app->get('/admin/Categort/deleteMain/{id}', "CategoryController:deleteMain")->setName('removeMainCategory');

	$app->get('/admin/SubCategories', "CategoryController:mainIndex")->setName('mainCategory');
	
}

if($container->auth->isTeacher()){
	$app->post("/update/teacher", "UserController:teacherUpdate")->setName("updateTeacher");
}
	
if($container->auth->isStudent()){
	$app->post("/update/student", "UserController:studentUpdate")->setName("updateStudent");
}

$app->post('/login', "AuthController:login")->setName('login');
$app->post("/signUp/teacher", "AuthController:teacherSignUp")->setName("signUpTeacher");
$app->post("/signUp/student", "AuthController:studentSignUp")->setName("signUpStudent");



$app->get('/allStudents', "HomeController:allStudents")->setName('allStudents');
$app->get('/allTeachers', "HomeController:allTeachers")->setName('allTeachers');

$app->get('/searchStudents', "HomeController:searchStudents")->setName('searchStudents');
$app->get('/searchTeachers', "HomeController:searchTeachers")->setName('searchTeachers');

$app->get('/logOut', "AuthController:logOut")->setName('logOut');

$app->get('/profile', "AuthController:profile")->setName('profile');


$app->post('/updateContact', "ContactController:updateContact")->setName('updateContact');


$app->post('/uploader', "UploadController:upload")->setName('upload');
$app->post('/deleteFile', "UploadController:deleteFile")->setName('deleteFile');


$app->get('/search', "SearchController:search")->setName('search');
$app->post('/search', "SearchController:search")->setName('searchPost');


$app->get('/lang', function ($req, $res, $args) {
	
	$_SESSION['lang'] = $req->getParam("lang");

    return $res->withRedirect($_SERVER['HTTP_REFERER']);

})->setName('chooseLanguage');

/*
$app->get('/foo', function ($request, $response, $args) {
    // Set flash message for next request
    $this->flash->addMessage('Test', 'This is a message');

    // Redirect
    return $response->withStatus(302)->withHeader('Location', '/projects/slim/public/bar');
});


$app->get('/bar', function ($request, $response, $args) {
    // Get flash messages from previous request
    $messages = $this->flash->getMessages();
    print_r($messages);
});
*/

