<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;

class Todo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'completed', 'user_id', 'description'
    ];

    /**
     * Get steps belongs to custom todo
     */
    public function steps() {
        return $this->hasMany(Step::class);
    }
}
