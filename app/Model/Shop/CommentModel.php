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
            $query = $this::select('id','user_id','product_id','parent_id','content','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            $result =  $query->orderBy('id', 'desc')->get();
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
