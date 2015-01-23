<?php namespace lib\iteratorFS;

//            echo '<pre>';
//            print_r($pathsubdirectories);
//            echo '</pre>';
class Parser {

    private $fs;

    public function __construct(FS $fs) {
        $this->fs = $fs;
    }

    public function find_files($path, $reverse) {
        $this->fs->set_config_reverse($reverse);

        $pathfiles = $this->fs->get_files($path);
        $this->fs->push_pathfiles($pathfiles);

        $pathdirectories = $this->fs->get_directories($path);

        foreach($pathdirectories as $key => $pathdirectory) {
            $this->get_files_recursive($pathdirectory, $this->fs->get_directories($pathdirectory));
        }
    }

    private function get_files_recursive(
        $path, $pathdirectories,
        $pathsubdirectories = array(), $queues = array(),
        $recursive = false)
    {
        $pathfiles = $this->fs->get_files($path);
        $this->fs->push_pathfiles($pathfiles);

        if($recursive) {
            $this->array_unshift($pathsubdirectories, $this->fs->get_directories($path));
        }

        if(empty($pathsubdirectories)) {
            $this->tester_path_directories(
                $pathdirectories, $pathsubdirectories,
                $queues, true);
        } else {
            $this->tester_path_sub_directories(
                $pathdirectories, $pathsubdirectories,
                $queues, true);
        }
    }

    private function array_unshift(&$target, $values) {
        if(!empty($values)) {
            for($i = count($values)-1; $i >= 0; $i--) {
                array_unshift($target, $values[$i]);
            }
        }
    }

    private function tester_path_directories(
        &$pathdirectories, &$pathsubdirectories,
        &$queues, $recursive)
    {
        if(!empty($pathdirectories)) {
            $path = $pathdirectories[0];
            array_shift($pathdirectories);
            $this->get_files_recursive(
                $path, $pathdirectories,
                $pathsubdirectories,
                $queues, $recursive);
        }
    }

    private function tester_path_sub_directories(
        &$pathdirectories, &$pathsubdirectories,
        &$queues, $recursive)
    {
        if(!empty($pathsubdirectories)) {
            $path = $pathsubdirectories[0];
            array_shift($pathsubdirectories);
            $this->get_files_recursive(
                $path, $pathdirectories,
                $pathsubdirectories,
                $queues, $recursive);
        }
    }
}