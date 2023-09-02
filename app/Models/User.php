<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //merupakan tempat pendefinisian kolom yang boleh diisi
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ //kolom-kolom yang disembunyikan yang menyebabkan ketika select all semua terselect kecuali data dalam hidden
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ //dapat mengubah data yang akan disimpan di db melalui casts
        'email_verified_at' => 'datetime',
    ];

    public $abc; //atribut

    public function get_abc(){ //method
        return $this->abc;
    }

    public static function print_sesuatu(){ //static function 
        echo "robirahman";
    }
}
