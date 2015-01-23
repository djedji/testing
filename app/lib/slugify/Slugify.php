<?php namespace lib\slugify;


class Slugify {


    public function str_remove_accents($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
        return $str;
    }

    public function make($str) {
        $pattern = '#(&)+#';
        $str = preg_replace($pattern, '-and-', $str);
        $str = $this->str_remove_accents($str);
        $str = strtolower($str);
        $pattern = '#(,|:|::|/|\\|.|\(|\))+#';
        $str = preg_replace($pattern, '', $str);
        $pattern = '#(\')+#';
        $str = preg_replace($pattern, '-', $str);
        $str = trim($str);
        $pattern = "#\s+#";
        return preg_replace($pattern, '-', $str);
    }
}