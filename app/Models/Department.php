<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = "dept_id";
    public $table = "departments";

    // Foreign Key Relation:
    public function employee(){
        return $this->hasMany('App\Models\Employee','deptId','dept_id');
    }
}
