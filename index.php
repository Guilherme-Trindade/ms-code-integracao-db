<?php

function dd(mixed $valor)
{
    echo '<pre>';
    print_r($valor);
    echo '</pre>';
}

$host = 'localhost'; // Host (No caso de você aluno, creio que seja localhost)
$db   = 'escola'; // Base banco (database)
$user = 'DOUGLAS'; // Usuário (User) do Admin
$pass = '1234'; // Senha (Passoward) do Admin
$port = '3306'; // Porta do Mysql
$charset = 'utf8mb4'; // Codificação

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false, // Essencial para performance e segurança real de prepared statements
];

$dados = [];

# Teste de conexão, garantia de que temos acesso ao banco.
try {
    $pdo = new PDO($dsn, $user, $pass);
    // echo "Conexão estabelecida com sucesso." . PHP_EOL;
} catch (\Exception $e) {
    throw new \Exception($e->getMessage(), (int)$e->getCode());
}


# CRUD
## Create(Criar)
## Read(Ler)
## Update(Atualizar)
## Delete(Excluir)

##### Read(Ler)
# Teste de query, retorno de valores definidos.
// try {
//     $sql = <<<SQL
//         SELECT * FROM escola.alunos WHERE alunos.country = 'Brazil'
//     SQL;
    
//    $dados = $pdo->query($sql)
//             ->fetchAll();


//     echo "Registro buscado com sucesso.";
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }

##### Create(Criar)
# Teste de Inserção, novo registro no banco.
// try {
//     $sql = <<<SQL
//         INSERT INTO escola.alunos (name, country)
//             VALUES (:name, :pais)
//     SQL;  

//     $pdo->prepare($sql)
//         ->execute([
//             "name" => "Douglas Brito",
//             "pais" => "Brazil"
//         ]);

//     $query = $pdo->prepare("SELECT * FROM escola.alunos WHERE id = :id");
//     $query->execute([
//         "id" => $pdo->lastInsertId()
//     ]);

//     $dados = $query->fetchAll();
//     echo "Novo Registro Inserido.";
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }

##### Update(Atualizar)
# Teste de alteração de tabela adicionando nova coluna no banco ou removendo coluna existente.
// try {
//     $sql = <<<SQL
//         UPDATE escola.alunos SET alunos.email = :email 
//         WHERE alunos.name = :name
//     SQL;


//    $pdo->prepare($sql)
//         ->execute([
//              "name" => "Douglas Brito",
//              "email" => "douglasbrito@gmail.com",
//          ]);

//     $query = $pdo->prepare("SELECT * FROM escola.alunos WHERE name = :name");
//     $query->execute([
//        "name" => "Douglas Brito",
//     ]);

//     $dados = $query->fetchAll();
//     echo "Registro atualizado com sucesso.";
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }

##### Delete(Excluir)
# Teste de remoção da informação, remover registro existente no banco.
// try {
//    $sql = <<<SQL
//         DELETE FROM escola.alunos WHERE name = :name
//     SQL;  

//     $pdo->prepare($sql)
//         ->execute([
//             "name" => "Douglas Brito",
//         ]);

//     $query = $pdo->prepare("SELECT * FROM escola.alunos WHERE name = :name");
//     $query->execute([
//         "name" => "Douglas Brito",
//     ]);

//     $dados = $query->fetchAll();

//     echo "<br/>";
//     echo "Registro removido com sucesso.";
// } catch (\Exception $e) {
//     throw new \Exception($e->getMessage(), (int)$e->getCode());
// }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usando PHP para integração com o banco de dados Mysql</title>
</head>
<body>
    <?php foreach ($dados as $dado) { ?>
        <p><?= $dado['name'] . ' - ' . $dado['country'] . ' - ' . $dado['email'] ?></p>
    <?php } ?>
</body>
</html>