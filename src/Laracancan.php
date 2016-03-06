<?php namespace Hamedmehryar\Laracancan;

/**
 * This class is the main entry point of entrust. Usually this the interaction
 * with this class will be done through the Laracancan Facade
 *
 * @license MIT
 * @package Hamedmehryar\Laracancan
 */

class Laracancan
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null.
     *
     * @return Illuminate\Auth\UserInterface|null
     */
    public function user()
    {
        return $this->app->auth->user();
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        if ($user = $this->user()) {
            return $user->roles();
        }
        return false;
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param $role
     * @param bool $requireAll All roles in the array are required.
     * @return bool
     * @internal param array|string $name Role name or array of role names.
     */
    public function hasRole($role, $requireAll = false)
    {
        if ($user = $this->user()) {
            return $user->hasRole($role, $requireAll);
        }
        return false;
    }

    /**
     * Function for viewable resources of user
     * @return array
     */
    function creatableResources(){

        if ($user = $this->user()) {
            return $user->creatableResources();
        }
        return false;
    }


    /**
     * Function for readable resources of user
     * @param $permission
     * @return array
     */
    function resourcesByPermission($permission){

        if ($user = $this->user()) {
            return $user->resourcesByPermission($permission);
        }
        return false;
    }

    /**
     * Function for readable resources of user
     * @return array
     */
    function readableResources(){

        if ($user = $this->user()) {
            return $user->readableResources();
        }
        return false;
    }


    /**
     * Function for updateable resources of user
     * @return array
     */
    function updatableResources(){

        if ($user = $this->user()) {
            return $user->updatableResources();
        }
        return false;
    }


    /**
     * Function for deletable resources of user
     * @return array
     */
    function deletableResources(){

        if ($user = $this->user()) {
            return $user->deletableResources();
        }
        return false;
    }

    /**
     * @param $resource
     * @return bool
     */
    function canCreate($resource){

        if ($user = $this->user()) {
            return $user->canCreate($resource);
        }
        return false;
    }

    /**
     * @param $resource
     * @return bool
     */
    function canRead($resource){

        if ($user = $this->user()) {
            return $user->canRead($resource);
        }
        return false;
    }



    /**
     * @param $resource
     * @return bool
     */
    function canUpdate($resource){

        if ($user = $this->user()) {
            return $user->canUpdate($resource);
        }
        return false;
    }

    /**
     * @param $resource
     * @return bool
     */
    function canDelete($resource){

        if ($user = $this->user()) {
            return $user->canDelete($resource);
        }
        return false;
    }

    /**
     * Check if the current user has a permission on a resource
     *
     * @param string $permission Permission string.
     * @param string $resource Resource string
     * @return bool
     */
    public function can($permission, $resource)
    {
        if ($user = $this->user()) {
            return $user->can($permission, $resource);
        }
        return false;
    }
}
