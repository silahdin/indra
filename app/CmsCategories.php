<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CmsCategories extends Model
{
    protected $table = 'cms_categories';
    protected $primaryKey = 'id';
    protected $fillable =   ['name_in', 'name_en', 'rowstate', 'created_at', 'updated_at'];
}
