<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsArticle extends Model{
    protected $table = 'cms_article';
    protected $primaryKey = 'article_id';
    protected $fillable =   ['img_head', 'url', 'title_in', 'title_en', 'short_content_in', 'short_content_en', 'content_in', 'content_en', 'categories_id', 'user_id', 'rowstate', 'created_at', 'updated_at'];
}
