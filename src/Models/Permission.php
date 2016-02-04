<?php namespace Hamedmehryar\Laracancan\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'lcc_permissions';
    public function resources(){
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Resource', 'resourcepermissions');
    }
}