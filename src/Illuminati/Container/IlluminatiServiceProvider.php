<?php
namespace Sergey\Illuminati;

class IlluminatiServiceProvider extends IlluminatiService{

    public function __construct(array $files) {
        $this->run($files);
    }

    public static function compareFiles(array $files){
        $source = new IlluminatiServiceProvider($files);
		return $source->getStatuses();
    }

    public function run($files){
        if(count($files) < 2) {
            // need more than one file
            return;
        } else {
		    $this->__processStack($files);
		}
    }
}