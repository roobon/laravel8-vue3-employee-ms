<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['firstname', 'lastname', 'address', 'country_id', 'state_id', 'city_id', 'department_id'];

    public function country()
    {
        return $this->belongsTo(related: Country::class, foreignKey: 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(related: State::class, foreignKey: 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(related: City::class, foreignKey: 'city_id');
    }

    public function department()
    {
        return $this->belongsTo(related: Department::class, foreignKey: 'department_id');
    }
}
