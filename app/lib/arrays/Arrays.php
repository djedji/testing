<?php namespace lib\arrays;


class Arrays {

    public function insert($arr, $keySearch, $mixedinsert) {
        foreach($arr as $i => $v) {
            if($v == $keySearch) {
                array_splice($arr, $i+1, -(count($arr)-($i+1)), $mixedinsert);
                return $arr;
            }
        }
    }

    public function array_sort() {

    }
}