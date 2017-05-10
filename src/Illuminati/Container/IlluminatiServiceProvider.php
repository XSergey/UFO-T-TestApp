<?php
namespace Sergey\Illuminati;

class IlluminatiServiceProvider extends IlluminatiService{

    public function __construct(array $files) {
        $this->run($files);
    }

    public static function compareFiles(array $files, $html = false){
        $source = new IlluminatiServiceProvider($files);
        
        if($html === true)
		    return $source->getHtml();
        else
            return $source->getStatuses();
    }

    protected function run($files){
        if(count($files) < 2) {
            // need more than one file
            return;
        } else {
		    $this->__processStack($files);
		}
    }

    protected function getHtml(){
        $html = '<html><head></head><body>';
        $html .= '<table>';
        $html .= '<thead>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach($this->difference as $d=>$diff)
        {            
            $html .= '<tr>';
            $html .= '<td>'.$d.'</td>';
            $html .= '<td>'.$diff['status'].'</td>';
            $html .= '<td>'.$diff['result'].'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        echo $html;
    }
}