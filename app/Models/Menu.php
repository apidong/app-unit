<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $casts = [
        'avaible' => 'json',
    ];

    protected $fillable = [
        'id',
        'type',
        'id_parent',
        'active',
        'classes',
        'data',
        'header',
        'icon',
        'icon_color',
        'key',
        'label',
        'label_color',
        'route',
        'target',
        'text',
        'topnav',
        'topnav_right',
        'topnav_user',
        'url',
        'permision',
        'available',
    ];

    // Relationship to itself
    public function submenu()
    {
        return $this->hasMany(Menu::class, 'id_parent');
    }
}
