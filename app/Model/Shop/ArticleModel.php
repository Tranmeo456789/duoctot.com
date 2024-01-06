<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class ArticleModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $primaryKey = "article_id";
    public function __construct() {
        $this->table               = 'article';
    }

    public function listItems($params = null, $options = null){
        $result = [];

        if ($options['task'] == 'frontend-list-items'){
            $result = self::with('catalog')
                        ->where('catalog_id', '>', 0)
                        ->orderBy('article_id', 'DESC')->limit(6)->get();
        }
        return $result;
    }
    public function catalog()
    {
        return $this->belongsTo(CatalogModel::class, 'catalog_id', 'id');
    }
}

