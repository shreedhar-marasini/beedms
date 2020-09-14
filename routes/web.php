<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/Route::get('/resetUser', 'ResetController@reset');
Route::get('/', function () {
    $logo = DB::table('master_settings')->where('key_name', '=', '_COMPANY_LOGO_')->first()->key_value;

    if (Auth::user() == null)
        return view('auth.login', compact('logo'));
    else
        return redirect('/dashboard');
});


Auth::routes();
//Route::get('/home', 'TestController@index')->name('home');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/homeIndex', function () {
    return redirect('/dashboard');

});

Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/user/UI', 'UserUIController@index')->name('userUi');
Route::get('user/uiChangeSkin/{skin}', 'UserUIController@changeSkin');
Route::get('user/uiChangeLayout/{key_name}/{value}', 'UserUIController@changeLayout');
Route::get('user/ui/clear', 'UserUIController@clearUi');


Route::post('profile/profilePic', 'UserController@profilePic');
Route::post('/profile/password', 'UserController@password');

Route::prefix('documents')->group(function () {

    Route::resource('/outgoingDocument', 'Documents\OutgoingDocumentController');
    Route::get('search', 'Documents\DocumentController@search');
    Route::get('outgoingDocument/getContent/{id}', 'Documents\OutgoingDocumentController@getContent');
    Route::get('outgoingDocument/getSubject/{id}', 'Documents\OutgoingDocumentController@getSubject');


    Route::get('/incomingDocument/getDepartmentEmail/{id}', 'Documents\IncomingDocumentController@getDepartmentEmail');
    Route::resource('/incomingDocument', 'Documents\IncomingDocumentController');
    Route::get('incomingDocumentDownload/{id}', 'Documents\IncomingDocumentController@downloadDocument');
    Route::get('incomingDocumentDownload/file/{id}', 'Documents\IncomingDocumentController@download');
    Route::get('incomingDocumentDownload/addFile/{id}', 'Documents\IncomingDocumentController@downloadAdd');
    Route::get('incomingDocumentPrint/{id}', 'Documents\IncomingDocumentController@printdocument');
    Route::put('incomingDocument/send/email/{id}', 'Documents\IncomingDocumentController@sendDocumentFromEmail');

    Route::resource('incomingDocument/comment', 'Documents\DocumentCommentController');
    Route::get('documentCommentDownload/{id}', 'Documents\DocumentCommentController@download');
    Route::get('incomingDocument/comment/delete/{id}', 'Documents\DocumentCommentController@destroy');
    Route::get('incomingDocument/{documentId}/incomingEditReminder/{id}', 'Documents\IncomingDocumentController@editReminder');


    Route::get('outgoingDocument/getInstitutionEmail/{id}', 'Documents\OutgoingDocumentController@getInstitutionEmail');
    Route::resource('/digitizedDocument', 'Documents\DigitizedDocumentController');
    Route::get('digitizedDocumentDownload/{id}', 'Documents\DigitizedDocumentController@downloadDocument');
    Route::put('digitizedDocument/send/email/{id}', 'Documents\DigitizedDocumentController@sendDocumentFromEmail');
    Route::get('digitizedDocument/{documentId}/digitizedEditReminder/{id}', 'Documents\DigitizedDocumentController@editReminder');
    Route::resource('digitizedDocument/comment', 'Documents\DocumentCommentController');
    Route::get('digitizedDocument/comment/delete/{id}', 'Documents\DocumentCommentController@destroy');


    Route::get('outgoingDocumentDownload/{id}', 'Documents\OutgoingDocumentController@downloadDocument');
    Route::get('outgoingDocumentDownload/no/{id}', 'Documents\OutgoingDocumentController@downloadDocument');
    Route::get('outgoingDocumentPrint/{id}', 'Documents\OutgoingDocumentController@printdocument');
    Route::get('outgoingDocumentPrint/no/{id}', 'Documents\OutgoingDocumentController@printDocument');
    Route::put('outgoingDocument/send/email/{id}', 'Documents\OutgoingDocumentController@sendDocumentFromEmail');
    Route::post('outgoingDocument/issue', 'Documents\OutgoingDocumentController@issue');
    Route::post('outgoingDocument/register', 'Documents\OutgoingDocumentController@register');

    Route::resource('outgoingDocument/comment', 'Documents\DocumentCommentController');
    Route::get('documentCommentDownload/{id}', 'Documents\DocumentCommentController@download');
    Route::get('outgoingDocument/comment/delete/{id}', 'Documents\DocumentCommentController@destroy');
    Route::get('outgoingDocument/{documentId}/outgoingEditReminder/{id}', 'Documents\OutgoingDocumentController@editReminder');
    Route::get('folder', 'Documents\DocumentController@getFolders');
    Route::get('folder/{id}', 'Documents\DocumentController@getFoldersById');
    Route::post('folderchange', 'Documents\DocumentController@updateDocumentFolderId');

});


/*z
 * Roles and Permission Route
 */
Route::prefix('configurations')->group(function () {
    Route::resource('/department', 'Configurations\DepartmentController');
    Route::resource('/designation', 'Configurations\DesignationController');
    Route::resource('/documentCategory', 'Configurations\DocumentCategoryController');
    Route::get('/documentCategory/status/{id}', 'Configurations\DocumentCategoryController@status');
    Route::resource('/fiscalYear', 'Configurations\FiscalYearController');
    Route::get('/fiscalYear/status/{id}', 'Configurations\FiscalYearController@status');
    Route::get('tag/search', 'Configurations\TagController@searchTag');
    Route::get('tag/list/{name}', 'Configurations\TagController@searchTagList');
    Route::resource('/tag', 'Configurations\TagController');
    Route::resource('/template', 'Configurations\TemplateController');
    Route::resource('/widget', 'Configurations\WidgetController');
    Route::get('/widget/status/{id}', 'Configurations\WidgetController@status');
    Route::resource('/designation', 'Configurations\DesignationController');
    Route::resource('/template', 'Configurations\TemplateController');
    Route::resource('/branding', 'Configurations\BrandingController');
    Route::resource('/ui', 'Configurations\UIController');
    Route::get('/uiChangeSkin/{skin}', 'Configurations\UIController@changeSkin');
    Route::get('/uiChangeLayout/{key_name}/{value}', 'Configurations\UIController@changeLayout');

});
Route::get('/user-widget', 'Configurations\WidgetController@userwidget');
Route::get('/user-widget/status/{id}', 'Configurations\WidgetController@userwidgetStatus');

Route::prefix('tools')->group(function () {
    Route::get('/', 'ToolController@index');
    Route::post('/institutionStore', 'ToolController@institutionStore');
    Route::post('/namecardStore', 'ToolController@namecardStore');
    Route::post('/departmentStore', 'ToolController@departmentStore');
    Route::post('/designationStore', 'ToolController@designationStore');
});


Route::get('/testpdf', 'CollectiveFunctionController@test');
Route::get('/get-english-date/{date}', 'CollectiveFunctionController@getEnglishDate');
Route::resource('folder', 'Document\Folder\FolderController');
Route::get('documents/folder-delete', 'Document\Folder\FolderController@destroy');

Route::get('get-folder-list/{folder_id}/{institution_id}', 'Document\Folder\FolderController@getFolderList');
Route::get('get-folder-name/{institution_id}/{folderName}', 'Document\Folder\FolderController@institutewiseFolderName');

Route::resource('/reminder', 'ReminderController');
Route::post('/reminder/snooze/{id}', 'ReminderController@snoozeupdate');

Route::prefix('logs')->group(function () {
    Route::get('/loginLog', 'LoginLogController@index');

    Route::get('/failLog', 'LoginLogController@failLogin');
});


/*
 * Roles and Permission Route
 */

Route::prefix('roles')->group(function () {
    Route::resource('/menu', 'Roles\MenuController');
    Route::get('/menu/menuControllerChangeStatus/{id}', 'Roles\MenuController@changeStatus');
    Route::resource('/group', 'Roles\GroupController');
    Route::get('/roleAccessIndex', 'Roles\RoleAccessController@index');
    Route::get('roleChangeAccess/{allowId}/{id}', 'Roles\RoleAccessController@changeAccess');
});

/*
 * User Route
 */
Route::get('user/searchList', 'UserController@searchList');
Route::resource('/user', 'UserController');
Route::get('/user/userControllerChangeStatus/{id}/{type}', 'UserController@changeStatus');
Route::post('/user/image', 'UserController@uploadImage');


/*
 * Notification URl
 */
Route::get('notification/notificationControllerShowAllNotifications', 'NotificationController@showAllNotifications');
Route::get('notification/link/{id}', 'NotificationController@updateNotificationTable');
Route::get('notification/readAll', 'NotificationController@readAll');


Route::resource('/institution', 'Institution\InstitutionController');
Route::get('/institution/nameCard/create/{id}', 'Institution\NameCardController@create');
Route::resource('/name-card', 'Institution\NameCardController');

Route::get('/get-institution-name', 'Institution\InstitutionController@getInstitutionNames');
Route::get('/get-name', 'Institution\NameCardController@getNames');
Route::post('/institution/nameCard/store', 'Institution\NameCardController@store');
Route::put('/institution/nameCard/update/{id}', 'Institution\NameCardController@update');

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    Artisan::call('config:clear');
    $exitCode = Artisan::call('optimize');
    // return what you want
});
Route::get('/storage-link', function () {

    $exitCode = Artisan::call('storage:link');

    return '<h1>storage:linked</h1>';
});

Route::get('backup-files', 'Documents\DocumentController@getBackup');
Route::get('document/{id}', 'Documents\DocumentFromQRController@getDocument');