<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_user
 * @property User $user
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admin';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
