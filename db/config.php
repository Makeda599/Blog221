<?php
require_once(ROOT."env.php");
function getDb() : PDO {
    static $db = null;
    if($db == null){
        try {
            $db = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",
                DB_USER,
                DB_PASSWORD
            );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    return $db;
}


function executeSelect(string $sql,array $data = [], $one = false){
    $db = getDb();
    $stmt = $db ->prepare($sql);
    $stmt ->execute(count($data) === 0 ? [] : $data );
    return $one ? $stmt->fetch() : $stmt -> fetchAll(); 
}

function executeUpdate(string $sql,array $data = []){
    $db = getDb();
    $stmt = $db ->prepare($sql);
    $stmt ->execute($data);
}


?>

