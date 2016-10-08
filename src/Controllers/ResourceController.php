<?php namespace Hamedmehryar\Laracancan\Controllers;

use Illuminate\Routing\Controller;
use Hamedmehryar\Laracancan\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){
			$resources = Resource::all();

			return view('laracancan::resource.list')
				->with('resources', $resources);

		}

		return response(view('laracancan::master.401'), 401);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){
			return view('laracancan::resource.add');
		}

		return response(view('laracancan::master.401'), 401);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){

			$user = Auth::user();
			$input = Input::all();
			$rules = [
				'name' => 'required|min:3|max:32',
				'display_name_en' => 'required|min:3|max:32',
				'display_name_pr' => 'required|min:3|max:32',
				'display_name_pa' => 'required|min:3|max:32',
				'table_name' => 'required|min:3',
				'model_name' => 'required|min:3',
			];
			$validator = Validator::make($input, $rules);
			$error_msg = $validator->errors();

			if(count($error_msg) != 0){
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$resources = Resource::where('name', '=', $input['name'])->get();
			$resources1 = Resource::where('display_name_en', '=', $input['display_name_en'])->get();
			$resources2 = Resource::where('display_name_pr', '=', $input['display_name_pr'])->get();
			$resources3 = Resource::where('display_name_pa', '=', $input['display_name_pa'])->get();
			if (count($resources) > 0 || count($resources1) > 0 || count($resources2) > 0 || count($resources3) > 0) {
				return redirect()->back()->with('flash_error', 'Resource already exist !');
			}


			$resource = new Resource();
			$resource->name = $input['name'];
			$resource->display_name_en = $input['display_name_en'];
			$resource->display_name_pr = $input['display_name_pr'];
			$resource->display_name_pa = $input['display_name_pa'];
			$resource->table_name = $input['table_name'];
			$resource->model_name = $input['model_name'];
			$resource->in_sidemenu = $input['in_sidemenu'];
			$resource->icon_class = $input['icon_class'];
			$resource->is_reportable = $input['is_reportable'];
			$resource->save();

			return redirect()->back()->with('flash_success', 'Resource added Successfully !');
		}

		return response(view('laracancan::master.401'), 401);
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
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')) {
			$resource = Resource::find($id);
			return view('laracancan::resource.edit')
				->with('resource', $resource);
		}

		return response(view('laracancan::master.401'), 401);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){

			$user = Auth::user();
			$input = Input::all();
			$rules = [
				'name' => 'required|min:3|max:32',
				'display_name_en' => 'required|min:3|max:32',
				'display_name_pr' => 'required|min:3|max:32',
				'display_name_pa' => 'required|min:3|max:32',
				'table_name' => 'required|min:3',
				'model_name' => 'required|min:3',
			];

			$validator = Validator::make($input, $rules);
			$error_msg = $validator->errors();

			if(count($error_msg) != 0){
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$resources = Resource::where('name', '=', $input['name'])->where('id', '!=', $id)->get();
			$resources1 = Resource::where('display_name_en', '=', $input['display_name_en'])->where('id', '!=', $id)->get();
			$resources2 = Resource::where('display_name_pr', '=', $input['display_name_pr'])->where('id', '!=', $id)->get();
			$resources3 = Resource::where('display_name_pa', '=', $input['display_name_pa'])->where('id', '!=', $id)->get();
			if (count($resources) > 0 || count($resources1) > 0 || count($resources2) > 0 || count($resources3) > 0) {
				return redirect()->back()->with('flash_error', 'Resource already exists!');
			}
			$resource = Resource::findOrFail($id);
			$resource->name = $input['name'];
			$resource->display_name_en = $input['display_name_en'];
			$resource->display_name_pr = $input['display_name_pr'];
			$resource->display_name_pa = $input['display_name_pa'];
			$resource->table_name = $input['table_name'];
			$resource->model_name = $input['model_name'];
			$resource->in_sidemenu = $input['in_sidemenu'];
			$resource->icon_class = $input['icon_class'];
			$resource->is_reportable = $input['is_reportable'];
			$resource->save();

			return redirect()->back()->with('flash_success', 'Resource edited Successfully !');

		}

		return response(view('laracancan::master.401'), 401);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){
			Resource::destroy($id);
			return redirect()->back()->with('flash_success', 'Resource deleted Successfully !');
		}

		return response(view('laracancan::master.401'), 401);
	}

	public function manageChildren($id){
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){
			$resource = Resource::find($id);
			return view('laracancan::resource.manage_children')
				->with('resource', $resource);
		}

		return response(view('laracancan::master.401'), 401);
	}

	public function postManageChildren($id){
		if(Auth::user() && Auth::user()->id == Config::get('laracancan.super_admin')){
			$children = Input::get('children', array());
			$resource = Resource::find($id);
			$resource->childResources()->detach();
			foreach($resource->parentResources as $parent){
				$parent->pivot->pivot = NULL;
				$parent->pivot->save();
			}
			foreach($children as $child){
				$pivot = Input::get($child.'_pivot');
				$resource->childResources()->attach([$child => ['pivot'=> $pivot]]);
				$potentialMutualResource = Resource::find($child);
				if($potentialMutualResource->isParentOf($id)){
					$potentialMutualResource->childResources()->detach($id);
					$potentialMutualResource->childResources()->attach([$id => ['pivot'=> $pivot]]);
				}
			}
			return redirect()->back()->with('flash_success', 'Records Updated Successfully');
		}

		return response(view('laracancan::master.401'), 401);
	}

}
