<?php namespace Hamedmehryar\Laracancan\Controllers;

use Illuminate\Routing\Controller;
use Hamedmehryar\Laracancan\Models\Resource;
use Hamedmehryar\Laracancan\Models\Permission;
use Hamedmehryar\Laracancan\Models\Resourcepermission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ResourcepermissionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user() != null && Auth::user()->canCreate('resourcepermission')){

			$resource = Resource::find(Input::get('resource_id'));
			return view('laracancan::permission.add_resourcepermission')
				->with('resource', $resource);

		}else{
			return "LOGOUT";
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::user() != null && Auth::user()->canCreate('resourcepermission')){

			$permissionIds = Input::get('permissions');
			if(count($permissionIds) > 0 ){
				$ps = Permission::whereIn('id', $permissionIds)->get();
				$permissions = array();
				foreach($ps as $p){
					$permissions[] = $p->id;
				}
				$resource = Resource::find(Input::get('resource_id'));
				$resource->resourcePermissions()->detach($permissions);
				$resource->resourcePermissions()->attach($permissions);

				return redirect()->back()->with('flash_success', 'Permissions added for this resource.');
			}else
			{
				return redirect()->back()->with('flash_warn', 'No permission selected!');
			}

		}else{
			return response(view('errors.401'), 401);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user() != null && Auth::user()->canDelete('resourcepermission')){

			$resource = Resource::find(Input::get('resource_id'));
			$resource->resourcePermissions()->detach([$id]);
			return redirect()->back()->with('flash_success', 'Permission successfully removed from this resource.');

		}else{
			return response(view('errors.401'), 401);
		}
	}

	public function canAlso($id){
		try {
			$resourcePermission = Resourcepermission::findorFail($id);
		} catch (ModelNotFoundException $e) {
			return "NOPERMISSION";
		}
		$resource = $resourcePermission->resource;
		$canAlsoes = Resourcepermission::where('resource_id', $resource->id)->where('id', '!=', $resourcePermission->id)->whereNull('parent_id')->whereNotIn('id', $resourcePermission->parentsIds())->get();

		return view('laracancan::permission.can_also')
			->with('resourcePermission', $resourcePermission)
			->with('canAlsoes', $canAlsoes)
			->with('resource', $resource);

	}
	public function postCanAlso($id){
		try{
			$resourcePermission = Resourcepermission::findOrFail($id);
		}catch(ModelNotFoundException $e){
			return redirect()->back()->with('flash_error', trans('permissions.permission_not_found'));
		}
		$resourcePermissionIds = Input::get('resourcepermissions');
		if($resourcePermissionIds != null){
			$resourcePermission->setChilds($resourcePermissionIds);
		}else{
			$resourcePermission->setChilds(array());
		}

		return redirect()->back()->with('flash_success', trans('permissions.records_edit_success'));
	}

}
