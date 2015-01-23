<?php namespace lib\slugify\facade;


use Illuminate\Support\Facades\Facade;

class Slugify extends Facade {

    protected static function getFacadeAccessor() { return 'slugify'; }
}