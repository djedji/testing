<?php  namespace lib\dater;


class Dater {

    public function render($timestamps, $params) {
//        $timestamps = strtotime('2014-12-30 18:02:20');
        $d = \IntlDateFormatter::create(
            $params['locale'],
            $params['dateFormatter'],
            $params['timeFormatter'],
            isset($params['timezone']) ? $params['timezone'] : null,
            isset($params['calendar']) ? $params['calendar'] : null,
            isset($params['format']) ? $params['format'] : null
        );
        return $d->format($timestamps);
    }

    public function params_possible() {
        $n = array(
            'full' => \IntlDateFormatter::FULL,
            'long' => \IntlDateFormatter::LONG,
            'medium' => \IntlDateFormatter::MEDIUM,
            'short' => \IntlDateFormatter::SHORT,

            'locale' => 'fr_FR',
            'timezone' => 'Europe/Paris',
            'calendar' => \IntlDateFormatter::GREGORIAN,
            'format' => 'dd/mm/yyyy',
        );
    }
}