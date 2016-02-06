<?php namespace Hamedmehryar\Laracancan\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'lcc_permissions';
    protected $fillable = ['name', 'display_name', 'description'];
    public function resources(){
        return $this->belongsToMany('Hamedmehryar\Laracancan\Models\Resource', 'lcc_resourcepermissions');
    }
}