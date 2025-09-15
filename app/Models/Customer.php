<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';
    //
    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'bank_account_number',
        'about'
    ];
    //
    protected $hidden = [];
    //
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    //
    public function getImageUrlAttribute(){
        //
        return $this->image ? asset('storage/' . $this->image) : asset('default_image/1744106498.jpg');
    }
}
