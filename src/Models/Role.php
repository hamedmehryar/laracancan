<?php namespace Hamedmehryar\Laracancan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    protected $table = 'lcc_roles';

	public function resourcePermissions(){
		return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Resourcepermission', 'lcc_resourcepermission_role');
	}

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('laracancan.user_model'), 'lcc_role_user');
    }

    /**
     * Function for resources of user based on a specific permission
     * @param $permission
     * @return array
     */
    function resourcesByPermission($permission){

        try{
            $permissionObj = Permission::where('name','=', $permission)->firstOrFail();
        }catch (ModelNotFoundException $e){
            return false;
        }
        $roleResourcePermissions = $this->resourcePermissions()->where('permission_id', $permissionObj->id)->get();
        $resources = array();
        foreach($roleResourcePermissions as $p ){
            $resources[] = $p->resource;
        }
        return $resources;

    }
}