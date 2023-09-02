<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model //nama modelnya harus sama dengan nama tabel di database kalau beda akan error
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [ //kalo pake create pada fungsi store di controller harus membuat konfigurasi fillable dulu untuk menentukan data apa yang boleh diisi
        'title',
        'content',
    ];

    public static function boot(){ //boot itu syntax bawaan laravel yang berfungsi untuk mentrigger event-event yang kita tuliskan
        parent::boot(); //untuk memanggil boot di parent classnya

        static::creating(function($post){ //nama $post bisa apa saja, namun disamakan saja dengan model/tabelnya, menurutku $post itu representasi dari model/tabel database sih wwkwk
            $post->slug=str_replace(' ', '-', $post->title);
        });
    }

    public function comments(){

        //syntaxnya seperti select * from comments where post_id, dimana difield tabel database comment terdapat field post_id, laravel akan secara langsung mencari post_id karena tabel starting point (post) memiliki nama class post jadi dicari yang depannya post sehingga dapatlah post_id
        return $this->hasMany(Comment::class);
    }

    public function total_comments(){
        return $this->comments()->count();
    }

    public function scopeActive($query){ //penggunaan scope agar kita dapat menggunakan query yang sering dipakai secara berulang-ulang dengan pendefinisian yang sederhana cuma pake active() doang di controllernya
        return $query->where('active', true); 
    }
}
