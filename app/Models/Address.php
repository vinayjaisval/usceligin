<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
  use SoftDeletes;
  protected $table = "address";
  protected $fillable = [
    'user_id',
    'customer_name',
    'phone',
    'zip',
    'email',
    'country_id',
    'state_id',
    'city',
    'flat_no',
    'landmark',
    'address',
    'is_billing',
    'same_address_shipping',
];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
   
}
