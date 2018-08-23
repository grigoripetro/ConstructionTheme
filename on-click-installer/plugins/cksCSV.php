<?php
class cksCSV {
	// text => index
	// 'name' => 0, 'day' => 1, etc
	private $header = null;
	private $header_map = null;
	private $data = null;
	
	function _construct() {
		
	}
	
	public function getHeader($col) {
		if(is_integer($col)) {
			return $this->header[$col];
		} else {
			return $this->header_map[$col];
		}
	}
	
	public function getData($col, $row) {
		if(isset($this->data[$row]))  {
			$d = $this->data[$row];
		} else {
			return false;
		}
		if(is_integer($col)) {
			return $d[$col];
		} else {
			return $d[$this->getHeader($col)];
		}
		
	}
	
	public function debug() {
		echo 'Header: <br/>';
		var_dump($this->header);
		
		echo 'Header Map: <br/>';
		var_dump($this->header_map);
		
		echo '<br/><br/>';
		
		echo 'Data: <br/>';
		var_dump($this->data);	
	}
	
	public function load($csv, $head=true) {
		$csv = dirname(__FILE__)."/plugins.csv";
if($csv){
$csv = fopen($csv,'r') or die('cant open file'); }
		// head
		if($csv){
		if($head)  {
			$header = fgetcsv($csv);// clears the first header row
			foreach($header as $key=>$value) {
				$this->header_map[$value] = $key;
				$this->header[] = $value;
			}
		} else {
			$header_map = null;
		}
		// data
		while(!feof($csv))  {
			$tmp = fgetcsv($csv);
			if($tmp !== false) {
				$this->data[] = $tmp;
			}
		} }
		fclose($csv);	
	}
}
