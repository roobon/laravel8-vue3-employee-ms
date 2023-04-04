<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['state_id', 'name'];

    public function state()
    {
        return $this->belongsTo(related: State::class, foreignKey: 'state_id');
    }

    public function employees()
    {
        return $this->hasMany(related: Employee::class, foreignKey: 'city_id');
    }
}
