<?php
class Product{
	private $conn;
	private $table;

	public function __construct(){
		$db = new DB();
		$this->conn = $db->getConnection();
		$this->table = "member2";
	}
    public function getAll() {
        $sql = "SELECT * from $this->table JOIN `users` on $this->table.id=users.user_id";
        return $this->conn->query($sql);
    }
    public function save($forename, $surname, $fileName) {
        $sql ="INSERT into $this->table( forename, surname, `picture`) VALUES('$forename', '$surname', '$fileName')";
        $this->conn->query($sql);
    }
    public function show($id) {
        $sql= "SELECT * from $this->table JOIN `users` on $this->table.id=users.user_id WHERE $this->table.id='$id'";
        return $this->conn->query($sql);
    }
    public function update($id, $forename, $surname, $fileName) {
        $sql = "UPDATE $this->table SET id = '$id',forename = '$forename',surname='$surname',picture ='$fileName' WHERE ID ='$id'";
        $this->conn->query($sql);
    }
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id ='$id'";
        $this->conn->query($sql);
    }

} //endClass