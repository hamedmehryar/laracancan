<?php namespace Hamedmehryar\Laracancan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;

class Resourcepermission extends Model {

    protected $table = 'lcc_resourcepermissions';
    public $timestamps = false;

	public function resource(){
        return $this->belongsTo('Hamedmehryar\Laracancan\Models\Resource');
    }
    public function permission(){
        return $this->belongsTo('Hamedmehryar\Laracancan\Models\Permission');
    }
    public function childResourcePermissions()
    {
        return $this->hasMany('Hamedmehryar\Laracancan\Models\Resourcepermission', 'parent_id', 'id');
    }
    public function parentResourcePermission()
    {
        return $this->hasOne('Hamedmehryar\Laracancan\Models\Resourcepermission', 'id', 'parent_id');

    }
    public function setChilds($childIds){
        $currentChildIds = $this->childIds();
        $deleteIds = array_diff($currentChildIds, $childIds);
        foreach($deleteIds as $id){
            $delete = Resourcepermission::find($id);
            self::where('parent_id', $this->id)->where('permission_id', $delete->permission_id)->where('resource_id', $delete->resource_id)->delete();
            foreach(Role::all() as $role){
                DB::table('lcc_resourcepermission_role')->where('role_id', $role->id)->where('parent_id', $this->id)->where('resourcepermission_id', $delete->id)->delete();
            }
        }
        $newChildIds = array_diff($childIds, $currentChildIds);
        foreach($newChildIds as $id){
            $child = new Resourcepermission();
            $child->permission_id = Resourcepermission::find($id)->permission_id;
            $child->resource_id = Resourcepermission::find($id)->resource_id;
            $child->parent_id = $this->id;
            $child ->save();
            foreach(Role::all() as $role){
                if($role->resourcePermissions()->where('id', $this->id)->exists()){
                    DB::table('lcc_resourcepermission_role')->insert(array('role_id'=>$role->id, 'resourcepermission_id'=>$child->id, 'parent_id'=>$this->id));
                }
            }
        }

    }
    public function removeChilds(){
        $this->childResourcePermissions()->delete();
    }
    public function parentsIds(){
        $ids =  self::whereNotNull('parent_id')
            ->where('permission_id', $this->permission_id)
            ->where('resource_id', $this->resource_id)
            ->lists('parent_id');
        if (!str_contains(Application::VERSION, '5.0')) {
            $ids = $ids->all();
        }
        return $ids;
    }

    public function childIds(){
        $childIds = array();
        foreach($this->childResourcePermissions as $child){
            $exactChild = self::where('resource_id', $child->resource_id)->where('permission_id', $child->permission_id)->whereNull('parent_id')->first();
            if($exactChild != null){
                $childIds[] = $exactChild->id;
            }
        }
        return $childIds;
    }

}
