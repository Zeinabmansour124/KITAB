<?php
include_once('IRepository.php');  
abstract class Repository implements IRepository {
    protected $db;
    public function __construct(protected $tableName) {
        $this->db = ConnexionDB::getInstance();
    }

    public function findAll() {
        $req = $this->db->query("SELECT * FROM {$this->tableName}");
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id) {
        $req = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_OBJ);
    }

    public function delete($id) {
        $req = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        return $req->execute([$id]);
    }
public function create($params) {
    $keys = array_keys($params);
    
    
    $protectedKeys = array_map(function($key) {
        return "`$key`";
    }, $keys);

    $colNames = implode(',', $protectedKeys);
    $placeholders = implode(',', array_fill(0, count($keys), '?'));
    
    $sql = "INSERT INTO {$this->tableName} ($colNames) VALUES ($placeholders)";
    
    $req = $this->db->prepare($sql);
    return $req->execute(array_values($params));
}
}