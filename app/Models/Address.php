<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address_category', // 'delivery' or 'billing'
        'type',
        'name',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pincode',
        'country',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Get the user that owns the address
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot method to ensure only one default address per user per category
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($address) {
            if ($address->is_default) {
                // Remove default from other addresses for this user in the same category
                static::where('user_id', $address->user_id)
                    ->where('address_category', $address->address_category ?? 'delivery')
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }

    /**
     * Scope for delivery addresses
     */
    public function scopeDelivery($query)
    {
        return $query->where('address_category', 'delivery');
    }

    /**
     * Scope for billing addresses
     */
    public function scopeBilling($query)
    {
        return $query->where('address_category', 'billing');
    }
}
