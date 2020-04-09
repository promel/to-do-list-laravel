<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoItem extends Model
{
    protected $fillable = ['user_id', 'title', 'detail'];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
