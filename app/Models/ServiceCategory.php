<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    public function products()
    {
        // Sesuaikan 'service_category_id' dengan nama foreign key di tabel products kamu
        return $this->hasMany(Product::class, 'service_category_id'); 
    }
}