<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['country_code', 'name'];

    public function states()
    {
        return $this->hasMany(related: State::class, foreignKey: 'country_id');
    }

    public function employees()
    {
        return $this->hasMany(related: Employee::class, foreignKey: 'country_id');
    }
}
