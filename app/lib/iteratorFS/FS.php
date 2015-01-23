<?php namespace lib\iteratorFS;

use Illuminate\Filesystem\Filesystem;
//            echo '<pre>';
//            print_r($old);
//            echo '</pre>';

class FS {

    private $Filesystem;

    private $configReverse;
    private $pathFiles;

    public function __construct(Filesystem $filesystem) {
        $this->Filesystem = $filesystem;
        $this->configReverse = __DIR__.'\settings\configReverse.txt';
        $this->pathFiles = __DIR__.'\settings\pathFiles.json';
        $this->Filesystem->delete($this->pathFiles);
    }

    public function set_settings_path() {
        $f = fopen($this->pathFiles, 'w');
        fclose($f);
    }

    public function set_config_reverse($reverse) {
        if($reverse) {
            $this->Filesystem->put($this->configReverse, 'reverse');
        } else {
            $this->Filesystem->put($this->configReverse, 'false');
        }
    }

    public function get_config_reverse() {
        return $this->Filesystem->get($this->configReverse);
    }

    public function get_files($path) {
        if($this->is_reverse()) {
            return array_reverse($this->Filesystem->files($path));
        }
        return $this->Filesystem->files($path);
    }

    public function get_directories($path) {
        if($this->is_reverse()) {
            return array_reverse($this->Filesystem->directories($path));
        }
        return $this->Filesystem->directories($path);
    }

    public function push_pathfiles($pathFiles) {
        if(!empty($pathFiles)) {
            if(!is_array($pathFiles)) {
                $pathFiles = str_replace('\\', '/', $pathFiles);
                $pathFiles = array(0 => $pathFiles);
            } else {
                foreach($pathFiles as $key => $val) {
                    $pathFiles[$key] = str_replace('\\', '/', $val);
                }
            }

            $old = $this->get_pathfiles();

            if(is_array($old)) {
                $pathFiles = array_merge($old, $pathFiles);
            }

            $this->Filesystem->put($this->pathFiles, json_encode($pathFiles));
        }
    }

    public function get_pathfiles() {
        $r = array();
        $js = json_decode($this->Filesystem->get($this->pathFiles));
        if($js) {
            foreach($js as $val) {
                array_push($r, $val);
            }
        }
        return $r;
    }

    public function is_file($path) {
        return $this->Filesystem->isFile($path);
    }

    public function is_directory($path) {
        return $this->Filesystem->isDirectory($path);
    }

    public function is_reverse() {
        if($this->get_config_reverse() == 'reverse') {
            return true;
        }
        return false;
    }

    public function delete() {
        $this->Filesystem->delete($this->pathFiles);
        $this->Filesystem->put($this->configReverse, 'false');
    }
}