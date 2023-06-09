<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name'];

    public function country()
    {
        return $this->belongsTo(related: Country::class, foreignKey: 'country_id');
    }

    public function cities()
    {
        return $this->hasMany(related: City::class, foreignKey: 'state_id');
    }

    public function employees()
    {
        return $this->hasMany(related: Employee::class, foreignKey: 'state_id');
    }
}
