<?php

$host = "localhost";
$db = "TRINDADE";
$user = "DOUGLAS";
$pass = "1234";
$port = "3306";
$charset = "utf8mb4";

$dns = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false, // Essencial para performance e segurança real de prepared statements
];

$dados = [];

#teste de conexão com banco de dados

try {
    $pdo = new PDO($dns, $user, $pass);
    echo "Conexão banco TRINDADE estabelecida com sucesso." . PHP_EOL;
} catch (\Exception $e) {
    throw new \Exception($e->getMessage(), (int)$e->getCode());
}


#teste de inserir nome e email no banco de dados
// try {
//     $sql = <<<SQL
//         INSERT INTO TRINDADE.alunos (name, email)
//             VALUES (:name, :email)
//     SQL;  

//     $pdo->prepare($sql)
//         ->execute([
//             "name" => "Breno silva",
//             "email" => "breno.silva@gmail.com"
//         ]);

//     $query = $pdo->prepare("SELECT * FROM TRINDADE.alunos WHERE id = :id");
//     $query->execute([
//         "id" => $pdo->lastInsertId()
//     ]);  
    
//     $dados = $query->fetchAll();
//     echo "Dados inseridos com sucesso." . PHP_EOL;
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }

#busca de dados no banco de dados
// try {
//     $sql = <<<SQL
//         SELECT * FROM TRINDADE.alunos WHERE alunos.name = 'Breno silva'
//     SQL;

//     $dados = $pdo->query($sql)
//              ->fetchAll();

//     echo "Registro buscado com sucesso." . PHP_EOL;
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }
