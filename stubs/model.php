<?php

namespace App\Repositories\ReplaceModule;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReplaceClass
 * @package App\Repositories\ReplaceModule
 */
class ReplaceClass extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ReplaceTable';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    
    /**
     * The attributes that aren't mass assignable.
     * 
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}