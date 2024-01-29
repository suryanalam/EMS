<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    
    protected $primaryKey = "eid";
    public $table = "employees";

    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Foreign Key Relation:
    public function department(){
        return $this->belongsTo('App\Models\Department','deptId');
    }

    // Mutators:
    public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }

    public function setPhoneAttribute($value){
        $number = "+91$value";
        $this->attributes['phone'] = $number;
    }

    // Accessors:
    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function getPhoneAttribute($value){
        $number = substr($value,3);
        return $number;
    }

    public function getRoleAttribute($value){
        if($value == 'bda'){
            return strtoupper($value);
        } 

        return ucwords($value); 
    }
}
