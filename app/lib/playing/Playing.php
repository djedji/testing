<?php namespace lib\playing;


use Illuminate\Filesystem\Filesystem;
use lib\arrays\Arrays;

class Playing {

    private $filesystem;
    private $arrays;

    public function __construct(Filesystem $filesystem, Arrays $arrays) {
        $this->filesystem = $filesystem;
        $this->arrays = $arrays;
    }

    public function run() {
        $arrs = $this->retrieve_array();
        echo $this->my_date();
        dd($this->arrays->array_insert($arrs, 'franck', 'jojo la praline'));

    }

    public function retrieve_array() {
        return $this->filesystem->getRequire(__DIR__.'\settings\normal.php');
    }

    public function my_date() {
        $dateFormatter = array(
            'full' => \IntlDateFormatter::FULL,
            'long' => \IntlDateFormatter::LONG,
            'medium' => \IntlDateFormatter::MEDIUM,
            'short' => \IntlDateFormatter::SHORT,
        );
        $locales = 'fr_FR';
        $timezone = 'Europe/Paris';
        $intlCalendar = \IntlDateFormatter::GREGORIAN;
        $format = 'dd/mm/yyyy';

        $d = \IntlDateFormatter::create(
            $locales,
            $dateFormatter['full'],
            $dateFormatter['medium'],
            $timezone
        );

//        $t = \DateTime::create('2014-12-30 18:02:20');
        return $d->format(strtotime('2014-12-30 18:02:20'));
    }


    public function g_arr() {
        $r = array(
            0 => array(
                0 => 'un',
                1 => 'trois',
                2 => 'cinq',
                3 => array(
                    0 => 8,
                    1 => 9
                )
            )
        );
    }

    public function array_sort_recursive($arr) {
        if(!empty($arr[0]) && is_array($arr[0])) {

        }
    }
}