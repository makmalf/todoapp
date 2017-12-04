<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'tasks';

    public function user() {
        return $this->belongsTo('App\User')->orderByDesc('created_at');
    }
}
