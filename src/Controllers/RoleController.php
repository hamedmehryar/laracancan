<?php namespace Hamedmehryar\Laracancan\Controllers;

use Illuminate\Routing\Controller;
use Hamedmehryar\Laracancan\Models\Resource;
use Hamedmehryar\Laracancan\Models\Role;
use Hamedmehryar\Laracancan\Models\Resourcepermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){
			$roles = Role::active()->get();

			return view('laracancan::role.list')
				->with('roles', $roles);

		}else{
			return response(view('errors.401'), 401);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){
			return view('laracancan::role.add');
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
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

			$input = Input::all();
			$rules = [
				'name' => 'required|min:3|max:32',
				'display_name' => 'required|min:3|max:32',
			];
			$validator = Validator::make($input, $rules);
			$error_msg = $validator->errors();

			if(count($error_msg) != 0){
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$role = Role::where('name', '=', $input['name'])->get();
			$role1 = Role::where('display_name', '=', $input['display_name'])->get();
			if (count($role) > 0 || count($role1) > 0) {
				return redirect()->back()->with('flash_error', 'Role already exists!');
			}


			$role = new Role();
			$role->name = $input['name'];
			$role->display_name = $input['display_name'];
			$role->description = $input['description'];
			$role->save();

			return redirect()->back()->with('flash_success', 'Role added Successfully!');
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
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

			$role = Role::find($id);
			return view('laracancan::role.edit')
				->with('role', $role);

		}else{
			return "LOGOUT";
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

			$input = Input::all();
			$rules = [
				'name' => 'required|min:3|max:32',
				'display_name' => 'required|min:3|max:32'
			];

			$validator = Validator::make($input, $rules);
			$error_msg = $validator->errors();

			if(count($error_msg) != 0){
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$role = Role::where('name', '=', $input['name'])->where('id', '!=', $id)->get();
			$role1 = Role::where('display_name', '=', $input['display_name'])->where('id', '!=', $id)->get();
			if (count($role) > 0 || count($role1) > 0) {
				return redirect()->back()->with('flash_error', 'Role already exists!');
			}
			$role = Role::findOrFail($id);
			$role->name = $input['name'];
			$role->display_name = $input['display_name'];
			$role->description = $input['description'];
			$role->save();

			return redirect()->back()->with('flash_success', 'Role edited Successfully !');

		}else{
			return response(view('errors.401'), 401);
		}
	}

	/**
     * Trash the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

            $role = Role::find($id);

            if($this->roleHasChild($role))
                return redirect()->back()->with('flash_error', 'This Role has some dependencies so, it can not be trashed!');

            $role->trash = ModelStatus::TRASHED;
            $role->save();
                return redirect()->back()->with('flash_success', 'Role trashed successfully!');

        }else{
            return response(view('errors.401'), 401);
        }
    }

    /**
     * checks weather the role has child or not.
     *
     * @param  object
     * @return Response
     */
    public function roleHasChild($role)
    {
        //break many to many relationship
        $role->resourcePermissions()->sync([]);
        $role->widgets()->sync([]);
        $role->users()->sync([]);

        //on to many relationship, if it has the resource will not be deleted
        $reportSettings = $role->reportSettings->count();

        if($reportSettings != 0) {
            return true;
        }else{
            return false;
        }
    }

	/**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
     public function delete($id)
     {
        if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

            $role = Role::find($id);
            $role->trash = ModelStatus::DELETED;
            $role->save();
                return redirect()->back()->with('flash_success', 'Role deleted successfully!');

        }else{
            return response(view('errors.401'), 401);
        }
     }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
     public function restore($id)
     {
         if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

             $role = Role::find($id);
             $role->trash = ModelStatus::ACTIVE;
             $role->save();
                 return redirect()->back()->with('flash_success', 'Role restored successfully!');
         }else{
             return response(view('errors.401'), 401);
         }
     }

	/**
	 * mange the specified role's from permissions.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function manageRolePermissions($id)
	{
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

			$role = Role::find($id);
			return view('laracancan::role.manage_permissions')
				->with('role', $role);

		}else{
			return "LOGOUT";
		}
	}

	public function manageRolePermissionsAction($id){

		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin')){

			$role = Role::find($id);
			$role->resourcePermissions()->detach();
			foreach(Resource::all() as $resource){
				$permissions = Input::get($resource->id."_resourcepermissions");
				if($permissions != null){

					foreach($permissions as $permission){
						$resourcePermission =  Resourcepermission::where('permission_id',$permission)->where('resource_id', $resource->id)->first();
						$role->resourcePermissions()->detach([$resourcePermission->id]);
						$role->resourcePermissions()->attach([$resourcePermission->id]);
						foreach($resourcePermission->childResourcePermissions as $child){
							$role->resourcePermissions()->attach([$child->id=>['parent_id'=>$resourcePermission->id]]);
						}

					}
				}
			}
			return redirect()->back()->with('flash_success', 'Permissions saved successfully!');

		}else{
			return response(view('errors.401'), 401);
		}

	}

}
