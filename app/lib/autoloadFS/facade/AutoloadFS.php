<?php namespace lib\autoloadFS\facade;


use Illuminate\Support\Facades\Facade;

class AutoloadFS extends facade {

    protected static function getFacadeAccessor() { return 'autoloadFS'; }
}