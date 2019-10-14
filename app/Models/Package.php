<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['valid_until']; 

    public function getValidUntilAttribute() 
    {   
        $valid = is_null($this->pivot) ? now() : $this->pivot->valid_until;

        return  carbon()->parse($valid)
                        ->locale(config('app.locale'))
                        ->isoFormat('Do MMMM YYYY');
    }

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function scopeActive($query)
    {
    	$query->where('valid_until', '>', now());
    }

    public function scopeExpired($query)
    {
    	$query->where('valid_until', '<', now());
    }

    public function scopeForSale($query)
    {
        $query->whereIn('name', ['bulanan', 'tahunan']);
    }
}
