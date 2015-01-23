<?php namespace lib\autoloadFS;


use lib\iteratorFS\IteratorFS;

class AutoloadFS {

    private $IteratorFS;
    private $LoaderHtml;

    public function __construct(IteratorFS $iteratorFS, LoaderHtml $loaderHtml) {
        $this->IteratorFS = $iteratorFS;
        $this->LoaderHtml = $loaderHtml;
    }

    public function run($path, $reverse = false) {
        $r = '';
        $pathFiles = $this->IteratorFS->get_path($path, $reverse);

        foreach ($pathFiles as $key => $pathFile) {
            $ext = $this->find_extension($pathFile);

            if($ext == 'js') {
                $r .= $this->LoaderHtml->load_js_file($pathFile);
            }

            if($ext == 'css') {
                $r .= $this->LoaderHtml->load_css_file($pathFile);
            }
        }
        return $r;
    }

    private function find_extension($pathFile) {
        return pathinfo($pathFile)['extension'];
    }
}