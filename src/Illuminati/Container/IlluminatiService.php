<?php
namespace Sergey\Illuminati;

class IlluminatiService {
	private $stack = [];
	private $statuses = [];

    protected function __processStack($files) {
		foreach($files as $index => $file){
			$this->stack[$index] = $this->readFileToBuffer($file);
		}

		return array_replace_recursive(
			$this->composeFilesFromStack($this->stack[0], $this->stack[1]),
			$this->composeFilesFromStack($this->stack[0], $this->stack[1], true)
		);
	}

	private function composeFilesFromStack($firstArray, $secondArray){
		$oldKey = 'old';
		$newKey = 'new';
		if ($reverseKey) {
			$oldKey = 'new';
			$newKey = 'old';
		}
		$difference = [];
		foreach ($firstArray as $firstKey => $firstValue) {
			if (is_array($firstValue)) {
				if (!array_key_exists($firstKey, $secondArray) || !is_array($secondArray[$firstKey])) {
					$difference[$oldKey][$firstKey] = $firstValue;
					$difference[$newKey][$firstKey] = '';
				} else {
					$newDiff = $this->composeFilesFromStack($firstValue, $secondArray[$firstKey], $reverseKey);
					if (!empty($newDiff)) {
						$difference[$oldKey][$firstKey] = $newDiff[$oldKey];
						$difference[$newKey][$firstKey] = $newDiff[$newKey];
					}
				}
			} else {
				if (!array_key_exists($firstKey, $secondArray) || $secondArray[$firstKey] != $firstValue) {
					$difference[$oldKey][$firstKey] = $firstValue;
					$difference[$newKey][$firstKey] = $secondArray[$firstKey];
				}
			}
		}
		
		return $difference;
	}

	protected function getStatuses(){

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