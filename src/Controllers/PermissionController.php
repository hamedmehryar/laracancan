<?php namespace Hamedmehryar\Laracancan\Controllers;

use Illuminate\Routing\Controller;
use Hamedmehryar\Laracancan\Models\Resource;
use Hamedmehryar\Laracancan\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user() != null && Auth::user()->id == Config::get('laracancan.super_admin'))
		{
			if(Input::get('ajax') == null){
				$resource = Resource::where('name', 'permission')->first();
				$resources = Resource::all();
				return view('laracancan::permission.list')
					->with('resource', $resource)
					->with('resources', $resources);

			}else{

			}
		}else{
			return redirect()->to('login');
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
			return view('laracancan::permission.add');
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
				'display_name' => 'required|min:3|max:32'
			];
			$validator = Validator::make($input, $rules);
			$error_msg = $validator->errors();

			if(count($error_msg) != 0){
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$permissions = Permission::where('name', '=', $input['name'])->get();
			$permissions1 = Permission::where('display_name', '=', $input['display_name'])->get();
			if (count($permissions) > 0 || count($permissions1) > 0) {
				return redirect()->back()->with('flash_error', 'Permission already exists!');
			}


			$permission = new Permission();
			$permission->name = $input['name'];
			$permission->display_name = $input['display_name'];
			$permission->description = $input['description'];
			$permission->save();

			return redirect()->back()->with('flash_success', 'Permission added Successfully !');
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

			$permission = Permission::find($id);
			return view('laracancan::permission.edit')
				->with('permission', $permission);

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
			$permissions = Permission::where('name', '=', $input['name'])->where('id', '!=', $id)->get();
			$permissions1 = Permission::where('display_name', '=', $input['display_name'])->where('id', '!=', $id)->get();
			if (count($permissions) > 0 || count($permissions1) > 0) {
				return redirect()->back()->with('flash_error', 'Permission already exists!');
			}
			$permission = Permission::findOrFail($id);
			$permission->name = $input['name'];
			$permission->display_name = $input['display_name'];
			$permission->description = $input['description'];
			$permission->save();

			return redirect()->back()->with('flash_success', 'Permission edited Successfully !');

		}else{
			return response(view('errors.401'), 401);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
