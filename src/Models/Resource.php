<?php namespace Hamedmehryar\Laracancan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

class Resource extends Model {

    protected $table = 'lcc_resources';

    public function resourcePermissions(){
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Permission', 'lcc_resourcepermissions')->where('parent_id', null);
    }

    public function childResources(){
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Resource', 'lcc_resourcerelations', 'resource_id', 'child_id')->withPivot('pivot');
    }

    public function childResourcesIds(){
        $query = $this->childResources()->lists('id');
        if(! str_contains(Application::VERSION, '5.0')){
            $query = $query->get();
        }
        return $query;
    }

    public function parentResources(){
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Resource', 'lcc_resourcerelations', 'child_id', 'resource_id')->withPivot('pivot');
    }

    public function parentResourcesIds(){
        $query = $this->parentResources()->lists('id');
        if(! str_contains(Application::VERSION, '5.0')){
            $query = $query->get();
        }
        return $query;
    }

    public function isChildOf($id){
        $parentsIds = $this->parentResourcesIds();
        if(in_array($id, $parentsIds)){
            return true;
        }
        return false;
    }

    public function isParentOf($id){
        $childrenIds = $this->childResourcesIds();
        if(in_array($id, $childrenIds)){
            return true;
        }
        return false;
    }
}
