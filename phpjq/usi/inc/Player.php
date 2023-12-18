<?php
require_once 'Database.php';

class Player extends Database
{
    protected $tableName = 'member2';
    
    public function getRows($start = 0, $limit) {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }
    public function getCount() :int {
        $sql = "SELECT count(*) as 카운트 FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['카운트']; // return int
    }
    public function uploadPhoto($file) {
        $fileTempPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $allowedExtn = ["jpg", "png", "gif", "jpeg"];
        if (in_array($fileExtension, $allowedExtn)) {
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'].'/phpjq/usi/uploads/'; //현재작업디렉토리
            $destFilePath = $uploadFileDir . $newFileName;
            if (move_uploaded_file($fileTempPath, $destFilePath)) {
                return $newFileName;
            }
        }
    }
    public function update($data, $id) {
        $fileds = '';
        $x = 1;
        $filedsCount = count($data);
        foreach ($data as $field => $value) {
            $fileds .= "{$field}=:{$field}";
            if ($x < $filedsCount) {
                $fileds .= ", ";
            }
            $x++;
        }
        $sql = "UPDATE {$this->tableName} SET {$fileds} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $data['id'] = $id;
            $stmt->execute($data); //excute([arr])
            //die($stmt->debugDumpParams());
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $this->conn->rollback();
        }
    }
    public function add($data) { //[컬럼명=>'값',필드명=>'val']
        $fileds = $placholders = [];
        foreach ($data as $field => $value) {
            $fileds[] = $field;
            $placholders[] = ":{$field}";
            // 테이블 (col1,col2,col3) VALUES (:col1,:col2,:col3)
        }
        $sql = "INSERT INTO {$this->tableName} (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
        $stmt = $this->conn->prepare($sql);
        try {
            $this->conn->beginTransaction();
            $stmt->execute($data); //excute([$arr])
            //die($stmt->debugDumpParams());
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            $this->conn->rollback();
        }
    }
    public function getRow($column, $value) {
        $sql = "SELECT * FROM {$this->tableName}  WHERE {$column}=:{$column}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$column}" => $value]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }
    public function deleteRow($id) {
        $sql = "DELETE FROM {$this->tableName}  WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([':id' => $id]);
            if ($stmt->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function searchPlayer($queryString, $start = 0, $limit = 4) {
        $sql = "SELECT * FROM {$this->tableName} 
        WHERE `forename` LIKE :search OR `surname` LIKE :search OR `email` LIKE :search
        ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "%{$queryString}%"]);
        //die($stmt->debugDumpParams());
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }
}
