<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
class CommentModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'comment';
        $this->controllerName      = 'comment';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'content','created_by', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if($options['task'] == "list-items-frontend") {
            $query = $this::select('id','user_id','product_id','shop_id','fullname','phone','email','parent_id','content','rating','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            if (isset($params['rating'])) {
                $query->whereNotNull('rating')->where('rating', '!=', '');
            }else {
                $query->where(function($q) {
                    $q->whereNull('rating')
                      ->orWhere('rating', '');
                });
            }
            $result =  $query->get();
            $result = self::buildTree($result);
        }
        if($options['task'] == "list-items-api") {
            $query = $this::select('id','fullname','parent_id','content','rating', 'created_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            if (isset($params['rating'])) {
                $query->whereNotNull('rating')->where('rating', '!=', '');
            }else {
                $query->where(function($q) {
                    $q->whereNull('rating')
                      ->orWhere('rating', '');
                });
            }
            $result =  $query->get();
            $result = self::buildTree($result);
        }
        if($options['task'] == "list-items-parent-id-0-api") {
            $query = $this::select('id','fullname','parent_id','content','rating', 'created_at');
            if (isset($params['parent_id'])) {
                $query->where('parent_id', $params['parent_id']);
            }
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            if (isset($params['rating'])) {
                $query->whereNotNull('rating')->where('rating', '!=', '');
            }else {
                $query->where(function($q) {
                    $q->whereNull('rating')
                      ->orWhere('rating', '');
                });
            }
            $result =  $query->get();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'content')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function averageRating($params = null, $options = null) {
        $result = null;
        if($options['task'] == "rating-star-average") {
            $query = $this::select('id','user_id','product_id','parent_id','content','rating','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            $comments = $query->whereIn('rating', [1, 2, 3, 4, 5])->get();
            $totalRatings = $comments->count();
            $totalRatingSum = $comments->sum('rating');
            $averageRating = $totalRatings > 0 ? $totalRatingSum / $totalRatings : 0;
            $averageRating = round($averageRating, 1);
            $result=$averageRating;
        }
        return $result;
    }
    public function ratingPercentages($params = null, $options = null) {
        $result = null;
        if ($options['task'] == "rating-percentage-star") {
            $query = $this::select('id', 'user_id', 'product_id', 'parent_id', 'content', 'rating', 'created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query = $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            $ratingsCount = $query->whereIn('rating', [1, 2, 3, 4, 5])
                                 ->groupBy('rating')
                                 ->selectRaw('rating, COUNT(*) as count')
                                 ->pluck('count', 'rating')
                                 ->toArray();       
            $totalRatings = array_sum($ratingsCount);
            $percentages = [];
            for ($i = 1; $i <= 5; $i++) {
                $count = isset($ratingsCount[$i]) ? $ratingsCount[$i] : 0;
                $percentage = $totalRatings > 0 ? round(($count / $totalRatings) * 100) : 0;
                $percentages[$i] = is_int($percentage) ? intval($percentage) : $percentage;
            }
            $result = $percentages;
        }
        return $result;
    }
    public function userComment(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
    public function replies()
    {
        return $this->hasMany('App\Model\Shop\CommentModel', 'parent_id', 'id')->orderBy('created_at', 'desc');
    }
    public function getAllReplies($parentId)
    {
        return $this->replies()->where('parent_id', $parentId)->get();
    }
    public static function getAllCommentsWithTreeStructure($productId)
    {
        $comments = self::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();
        $commentsTree = self::buildTree($comments);
        return $commentsTree;
    }
    protected static function buildTree($comments, $parentId = 0, $level = 0)
    {
        $tree = [];
        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $comment->level = $level;
                $tree[] = $comment;
                $tree = array_merge($tree, self::buildTree($comments, $comment->id, $level + 1));
            }
        }
        return $tree;
    }
}
