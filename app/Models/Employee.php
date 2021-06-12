<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use \App\Traits\SelfReferenceTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position', 'superior', 'startDate', 'endDate'
    ];

    protected static $rules = [
        'name' => 'required',
        'position' => 'required'
    ];

    protected static $messages = [
        'name.required' => 'Employee name is required',
        'position.required' => 'Employee position is required'
    ];
}
