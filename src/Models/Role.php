<?php

namespace selfreliance\fixroles\Models;

use Selfreliance\fixroles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Slugable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'accessible'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }
}
