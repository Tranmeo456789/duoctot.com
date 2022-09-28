<?php
use App\Model\Shop\ProductModel;
use App\Model\Shop\CatProductModel;
function data_tree1($data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($data as $item) {
        if ($parent_id == $item['parent_id']) {
            $item['level'] = $level;
            $result[] = $item;
            $child = data_tree1($data, $item['id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}
function child_cat($data=null, $id=null)
{
    $result = [];
    foreach ($data as $item) {
        if ($item['id'] == $id) {
            $item['level'] = 1;
            $result[] = $item;
            $child = data_tree1($data, $item['id'], 2);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

function product_of_cat($id=null)
{
    $data = CatProductModel::all();
    $list_cat = child_cat($data, $id);
    $list_id_cat = [];
    foreach ($list_cat as $item) {
        $list_id_cat[] = $item['id'];
    }
    $products = ProductModel::whereIn('cat_product_id', $list_id_cat)->get();
    return ($products);
}

