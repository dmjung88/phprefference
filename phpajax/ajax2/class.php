<?php require_once "db.php";
class User extends DB {
    public function insert($f,$l,$e,$p){
        $query = "INSERT INTO member2(forename,surname,email,password) VALUES(?,?,?,?) ";
        $stmt = $this->connect()->prepare($query); //DB::connect()
        if($stmt->execute([$f,$l,$e,$p])){
			echo "등록 성공!";
		}
    }
    public function load(){
        $query = "SELECT * FROM member2";
        $stmt = $this->connect()->prepare($query); //DB::connect()
        $stmt->execute();
        $out = "";
        $out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ID</th><th>First Name</th><th>Last Name</th><th>Occupation</th><th>City</th><th>Email</th><th colspan='2'>Option</th></tr>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
            $first = $row['forename'];
            $last = $row['surname'];
            $email = $row['email'];
            $out .="<tr><td>$id</td><td>$first</td><td>$last</td><td>$email</td>";
            $out .="<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
            $out .="<td><span data-id= '$id' class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
        }
        $out .= "</table>";
        if($stmt->rowCount() == 0 ){
            $out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>No records yet. its time to add new!</p>";
        }
        return $out;
    } //endFunction
    public function search($text) {
        $text = strtolower($text);
        $query = "SELECT * FROM `MEMBER2` WHERE forename LIKE ? OR surname LIKE ? OR joined LIKE ? OR email LIKE ? or picture LIKE ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$text,$text,$text,$text,$text]);
        $out = "";
        $out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ID</th><th>First Name</th><th>Last Name</th><th>Occupation</th><th>City</th><th>Email</th><th colspan='2'>Option</th></tr>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $out .="<tr><td>$row[id]</td><td>$row[forename]</td><td>$row[surname]</td><td>$row[joined]</td><td>$row[email]</td><td>$row[picture]</td>";
            $out .="<td><a href='edit.php?id=$row[id]' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
            $out .="<td><span id=$row[id] class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
        }
        $out .= "</table>";
        if($stmt->rowCount() == 0 ){
            $out = "";
			$out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
        }
        return $out;
    }
    public function get_row($id) {
        $query = "SELECT * FROM `MEMBER2` WHERE id = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$id]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
		}
    }

    public function update($id,$f,$l) {
        $query = "UPDATE `MEMBER2` SET forename = ?, surname = ? where id = ? ";
        $stmt = $this->connect()->prepare($query);
        if($stmt->execute([$f,$l,$id])){
			echo "업데이트 성공 <a href='index.php'>view</a>";
		}

    }

    public function delete($id) {
        $query = "DELETE FROM `MEMBER2` WHERE id = ?";
        $stmt = $this->connect()->prepare($query);
		if($stmt->execute([$id])){
			echo "1 record deleted.";
		}
    }

}