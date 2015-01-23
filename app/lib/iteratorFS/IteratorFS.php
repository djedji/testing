<?php namespace lib\iteratorFS;

//echo '<pre>';
//print_r($this->get_pathfiles());
//echo '</pre>';

class IteratorFS {

    private $fs;
    private $Parser;

    public function __construct(FS $fs, Parser $parser) {
        $this->fs = $fs;
        $this->Parser = $parser;
    }

    public function get_path($path, $reverse = false) {
        $this->fs->set_settings_path();

        // is file
        if($this->fs->is_file($path)) {
            $this->fs->push_pathfiles($path);
        }

        // is directory
        if($this->fs->is_directory($path)) {
            $this->Parser->find_files($path, $reverse);
        }

        return $this->get_pathfiles();
    }

    public function get_pathfiles() {
        $r = $this->fs->get_pathfiles();
        $this->fs->delete();
        return $r;
    }
}