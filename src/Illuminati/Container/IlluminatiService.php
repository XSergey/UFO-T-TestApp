<?php
namespace Sergey\Illuminati;

class IlluminatiService {

	private $stack = [];

	private $statuses = [
		'NotChanged' => '',
		'Changed' => '*',
		'NotExistFirst' => '+',
		'NotExistSecond' => '-'
	];

	private $format = [
		'{first} | {second}'
	];

	protected $difference = [];

    protected function __processStack($files) {
		foreach($files as $index => $file){
			$this->stack[$index] = $this->readFileToBuffer($file);
		}

		$this->difference = $this->composeFilesFromStack();
	}

	private function composeFilesFromStack(){
		$res = [];
		//create array with same column and row sizes
		for($list = 0; $list <= max(array_column($this->stack, 'count')) - 1; $list++){
			$res[$list+1] = $this->checkWord(
								$this->stack[0]['rows'][$list], 
								$this->stack[1]['rows'][$list]
							);
		}
		return $res;
	}

	protected function checkWord(string $first = null, string $second = null){
		$difference = [];

		// bad spaces from files
		$first = trim($first);
		$second = trim($second);

		if($first == $second && !empty($first) && !empty($second)) {
			$difference['status'] = $this->statuses['NotChanged'];
			$difference['result'] = $second;
		} else if($first !== $second && !empty($first) && !empty($second)){
			var_dump($first);
			$difference['status'] = $this->statuses['Changed'];
			$difference['result'] = $this->formatString($first, $second)[0];
		} else if(empty($first) && !empty($second)){
			$difference['status'] = $this->statuses['NotExistFirst'];
			$difference['result'] = $second;
		} else if(empty($second) && !empty($first)){
			$difference['status'] = $this->statuses['NotExistSecond'];
			$difference['result'] = $first;
		}
		return $difference;
	}

	protected function getStatuses(){
		return $this->difference;
	}

	private function formatString(string $first, string $second){
		return str_replace(['{first}', '{second}'], [$first, $second], $this->format);
	}

	private function readFileToBuffer($file){
		$buffer = [];
		$handle = fopen($file, "r");
		if ($handle) {
			while (!feof($handle)) {
				$buffer['rows'][] = fgets($handle);
			}
			fclose($handle);
			$buffer['count'] = count($buffer['rows']);
		} else {
			// error opening the file.
			return;
		} 
		return $buffer;
	}
}