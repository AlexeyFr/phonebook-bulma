<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{

    public $timestamps = false;

    protected $guarded = ['id'];

}
