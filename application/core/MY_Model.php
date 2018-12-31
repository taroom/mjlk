<?php
class MY_Model extends CI_Model{
	public $tableName;
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function setTableName($name)
	{
		$this->tableName = $name;
	}

	function get(){
		return $this->db->get($this->tableName);
	}

	function one($key){
		$this->db->where($key);
		return $this->db->get($this->tableName);
	}
	
	function input_data($data){
		$this->db->insert($this->tableName,$data);
	}

	function update_data($data, $key){
		$this->db->update($this->tableName,$data, $key);
	}

	function delete_data($key){
		$this->db->delete($this->tableName,$key);
	}
}