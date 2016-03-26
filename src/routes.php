<?php


Route::get('lcc', function(){
	if(Auth::user() != null && Auth::user()->id == Config::get("laracancan.super_admin")){
		return view('laracancan::master.master');
	}
	return "Not Allowed!";
});

///////////////////Permission //////////////////////////////////////////////////////////////////
Route::resource('lccpermission', 'Hamedmehryar\Laracancan\Controllers\PermissionController');
///////////////////////////////////////////////////////////////////////////////////////////////



/////////////////// ReourcePermission /////////////////////////////////////////////////////////
Route::group(['prefix'=>'lccresourcepermission'], function(){
	Route::get('/{id}/can-also',['as'=>'lccresourcepermission.canAlso', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController@canAlso']);
	Route::post('/{id}/can-also',['as'=>'lccresourcepermission.postCanAlso', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController@postCanAlso']);
});
Route::resource('lccresourcepermission', 'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController');
///////////////////////////////////////////////////////////////////////////////////////////////


/////////////////// Reource ///////////////////////////////////////////////////////////////////
Route::resource('lccresource', 'Hamedmehryar\Laracancan\Controllers\ResourceController');
Route::group(['prefix'=>'lccresource'], function(){
	Route::get('/{id}/manage_children',['as'=>'lccresource.manageChildren', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourceController@manageChildren']);
	Route::post('/{id}/manage_children',['as'=>'lccresource.postManageChildren', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourceController@postManageChildren']);
});
///////////////////////////////////////////////////////////////////////////////////////////////

/////////////////// Role /////////////////////////////////////////////////////////////////////
Route::group(['prefix'=> 'lccrole'], function(){
	Route::get('/{id}/manage_role_permissions',['as'=>'lccrole.managePermissions', 'uses'=>'Hamedmehryar\Laracancan\Controllers\RoleController@manageRolePermissions']);
	Route::post('/{id}/manage_role_permissions',['as'=>'lccrole.postManagePermissions', 'uses'=>'Hamedmehryar\Laracancan\Controllers\RoleController@manageRolePermissionsAction']);
});
Route::resource('lccrole', 'Hamedmehryar\Laracancan\Controllers\RoleController');
///////////////////////////////////////////////////////////////////////////////////////////////