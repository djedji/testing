<?php namespace lib\autoloadFS;

use Illuminate\Html\HtmlBuilder;

class LoaderHtml {

    private $HtmlBuilder;

    public function __construct(HtmlBuilder $htmlBuilder) {
        $this->HtmlBuilder = $htmlBuilder;
    }

    public function load_js_file($pathFile) {
        return $this->HtmlBuilder->script($pathFile);
    }

    public function load_css_file($pathFile) {
        return $this->HtmlBuilder->style($pathFile);
    }
}