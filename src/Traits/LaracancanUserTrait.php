<?php namespace Hamedmehryar\Laracancan\Traits;


use Hamedmehryar\Laracancan\Models\Resource;
use Illuminate\Support\Facades\Config;

trait LaracancanUserTrait{

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Role', 'lcc_role_user', 'user_id', 'role_id');
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name       Role name or array of role names.
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role)
    {
        if(is_object($role)) {
            $role = $role->getKey();
        }

        if(is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    /**
     * Attach multiple roles to a user
     *
     * @param mixed $roles
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Detach multiple roles from a user
     *
     * @param mixed $roles
     */
    public function detachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * Function for viewable resources of user
     * @return array
     */
    function creatableResources(){

        return $this->resourcesByPermission('create');
    }


    /**
     * Function for readable resources of user
     * @return array
     */
    function readableResources(){

        return $this->resourcesByPermission('read');
    }


    /**
     * Function for updateable resources of user
     * @return array
     */
    function updatableResources(){

        return $this->resourcesByPermission('update');
    }


    /**
     * Function for deletable resources of user
     * @return array
     */
    function deletableResources(){

        return $this->resourcesByPermission('delete');
    }

    /**
     * @param $resource
     * @return bool
     */
    function canCreate($resource){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission('create');
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }
        return in_array($resource, $resourceNames);
    }

    /**
     * @param $resource
     * @return bool
     */
    function canRead($resource){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission('read');
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }
        return in_array($resource, $resourceNames);
    }



    /**
     * @param $resource
     * @return bool
     */
    function canUpdate($resource){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission('update');
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }
        return in_array($resource, $resourceNames);
    }

    /**
     * @param $resource
     * @return bool
     */
    function canDelete($resource){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission('delete');
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }

        return in_array($resource, $resourceNames);
    }

    /**
     * @param $resource
     * @return bool
     */
    function canTrash($resource){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission('trash');
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }

        return in_array($resource, $resourceNames);
    }

    /**
     * @param $resource
     * @param $permission
     * @return bool
     */
    function can($resource, $permission){

        if($this->id == Config::get('laracancan.super_admin',0)){
            return true;
        }
        $resources = $this->resourcesByPermission($permission);
        $resourceNames = array();
        foreach($resources as $r){
            $resourceNames[] = $r->name;
        }
        return in_array($resource, $resourceNames);
    }

    /**
     * Function for resources of user based on a specific permission
     * @param $permission
     * @return array
     */
    function resourcesByPermission($permission){
        if($this->id == Config::get('laracancan.super_admin',0)){
            return Resource::all();
        }
        $roles = $this->roles;
        $resourses = array();
        foreach($roles as $role){
            $resourses =  array_merge($resourses, $role->resourcesByPermission($permission));
        }
        $resourses = array_unique($resourses);
        return $resourses;

    }

    /**
     * @Desc This function's usage is to get roles of user which has access by to specific resource/resources
     * @param array(resources)
     * @return user resources roles array()
     */
    function rolesByResources($resources = array()){

        $resourceRoles = array();
        $userRoles = $this->roles;
        $i = 0;
        foreach($userRoles as $role){
            $roleResources = $role->resourcePermissions;
            foreach($roleResources as $r){
                if(in_array($r->resource_id,$resources)){
                    if(!in_array($role->name,$resourceRoles)){
                        $resourceRoles[$i]['role_id'] = $role->name;
                        $resourceRoles[$i]['id'] = $role->name;
                    }
                }
            }
            $i++;
        }
        return $resourceRoles;
    }
}