<?php 

class Userfunction{

	private $DBHOST='localhost';
	private $DBUSER='root';
	private $DBPASS='';
	private $DBNAME='test';

	public $conn;

    protected $tblname = 'member2';

    public function __construct(){
        $this->conn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
        if(!$this->conn){
            return false;
        }
    }
    public function htmlvalidation($form_data) {
        $form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
        $form_data = mysqli_real_escape_string($this->conn, trim(strip_tags($form_data)));
        return $form_data;
    }
    public function search($search_val, $op) {
        $search = "";
        foreach($search_val as $s_key => $s_value){
			$search = $search."$s_key LIKE '%$s_value%' $op ";
		}
        $search = rtrim($search, "$op ");

        $sql = "SELECT * FROM $this->tblname WHERE $search";
        $search_query = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($search_query) > 0){
            $serch_fetch = mysqli_fetch_all($search_query, MYSQLI_ASSOC);
            return $serch_fetch;
        }else {
            return false;
        }
    }
    public function select($table) {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $select_fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $select_fetch;
        } else {
            echo "no data";
        }
    }
    public function insert($table, $data) {
        $query_data = "";
        foreach ($data as $column => $q_value) {
            $query_data = $query_data."$column='$q_value',";
        }
        $query_data = rtrim($query_data,","); //col1='q_value',col2=''
        $query = "INSERT INTO $table SET $query_data";
        $result = mysqli_query($this->conn, $query);
        if($result) 
            return $result;
		else
			return false;
    }
    public function select_edit($table, $data,$op='AND') {
        $field_op = "";
		foreach ($data as $column => $q_value) {
			$field_op = $field_op."$column='$q_value' $op "; //id=1 and col1=''
		}
		$field_op = rtrim($field_op,"$op ");
        $sql = "SELECT * FROM $table WHERE $field_op";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($result) == 1) {
            $select_edit = mysqli_fetch_assoc($result);
            return $select_edit;
        }else 
            return false;
    }
    public function update($data, $pk) {
        $op='AND';
        $field_row = "";
		foreach ($data as $q_key => $q_value) {
			$field_row = $field_row."$q_key='$q_value',";
		}
		$field_row = rtrim($field_row,",");

		$field_op = "";

		foreach ($pk as $q_key => $q_value) {
			$field_op = $field_op."$q_key='$q_value' $op ";
		}
		$field_op = rtrim($field_op,"$op ");
        //col1='',col2='',col3=' WHERE id='1'

		$sql = "UPDATE $this->tblname SET $field_row WHERE $field_op";
        $rs = mysqli_query($this->conn, $sql);
        if($rs)
            return $rs;
        else
            return false;
    }
    public function delete($data, $op='AND') {
        $delete_data = "";

		foreach ($data as $pk => $q_value) {
			$delete_data = $delete_data."$pk='$q_value' $op ";
		}
        $delete_data = rtrim($delete_data,"$op ");		
		$sql = "DELETE FROM $this->tblname WHERE $delete_data"; // id='1'
        $result = mysqli_query($this->conn, $sql);
        if($result){
			return $result;
        } else {
			return false;
		}
    }

}
?>