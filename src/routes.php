<?php

Route::group(['prefix'=>'laracancan'], function(){
	///////////////////Permission //////////////////////////////////////////////////////////////////
	Route::resource('lcc.permission', 'Hamedmehryar\Laracancan\Controllers\PermissionController');
	///////////////////////////////////////////////////////////////////////////////////////////////



	/////////////////// ReourcePermission /////////////////////////////////////////////////////////
	Route::group(['prefix'=>'resourcepermission'], function(){
		Route::get('/{id}/can-also',['as'=>'lcc.resourcepermission.canAlso', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController@canAlso']);
		Route::post('/{id}/can-also',['as'=>'lcc.resourcepermission.postCanAlso', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController@postCanAlso']);
	});
	Route::resource('lcc.resourcepermission', 'Hamedmehryar\Laracancan\Controllers\ResourcepermissionController');
	///////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////// Reource ///////////////////////////////////////////////////////////////////
	Route::resource('lcc.resource', 'Hamedmehryar\Laracancan\Controllers\ResourceController');
	Route::group(['prefix'=>'resource'], function(){
		Route::get('/{id}/manage_children',['as'=>'lcc.resource.manageChildren', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourceController@manageChildren']);
		Route::post('/{id}/manage_children',['as'=>'lcc.resource.postManageChildren', 'uses'=>'Hamedmehryar\Laracancan\Controllers\ResourceController@postManageChildren']);
	});
	///////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////// Role /////////////////////////////////////////////////////////////////////
	Route::group(['prefix'=> 'role'], function(){
		Route::get('/{id}/manage_role_permissions',['as'=>'lcc.role.managePermissions', 'uses'=>'Hamedmehryar\Laracancan\Controllers\RoleController@manageRolePermissions']);
		Route::post('/{id}/manage_role_permissions',['as'=>'lcc.role.postManagePermissions', 'uses'=>'Hamedmehryar\Laracancan\Controllers\RoleController@manageRolePermissionsAction']);
	});
	Route::resource('lcc.role', 'Hamedmehryar\Laracancan\Controllers\RoleController');
	///////////////////////////////////////////////////////////////////////////////////////////////
});