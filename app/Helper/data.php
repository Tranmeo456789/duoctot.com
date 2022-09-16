<?php

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

