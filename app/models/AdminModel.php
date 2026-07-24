<?php
class AdminModel
{
    private $db;

    public function __construct()
    {
        //Conexión BD
        require_once APP_PATH . '/config/database.php';
        $this->db = $pdo;
    }

    public function getByEmail(string $email){
        $sql = 'SELECT * FROM administradores WHERE correo = :email LIMIT 1';

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['email' => $email]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
