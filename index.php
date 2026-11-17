<?php
# CRUD
## Create(Criar)
## Read(Ler)
## Update(Atualizar)
## Delete(Excluir)

##### Read(Ler)
# Teste de query, retorno de valores definidos.
// try {
//     $sql = <<<SQL
//         SELECT * FROM mscode.alunos WHERE alunos.country = 'Brazil'
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
//         INSERT INTO mscode.alunos (name, country)
//             VALUES (:name, :pais)
//     SQL;  

//     $pdo->prepare($sql)
//         ->execute([
//             "name" => "Guilherme Venturini",
//             "pais" => "Brazil"
//         ]);

//     $query = $pdo->prepare("SELECT * FROM mscode.alunos WHERE id = :id");
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
//         UPDATE mscode.alunos SET alunos.email = :email 
//         WHERE alunos.name = :name
//     SQL;


//    $pdo->prepare($sql)
//         ->execute([
//              "name" => "Guilherme Venturini",
//              "email" => "moveissimonetti@gmail.com",
//          ]);

//     $query = $pdo->prepare("SELECT * FROM mscode.alunos WHERE name = :name");
//     $query->execute([
//        "name" => "Guilherme Venturini",
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
//         DELETE FROM mscode.alunos WHERE name = :name
//     SQL;  

//     $pdo->prepare($sql)
//         ->execute([
//             "name" => "Guilherme Venturini",
//         ]);

//     $query = $pdo->prepare("SELECT * FROM mscode.alunos WHERE name = :name");
//     $query->execute([
//         "name" => "Guilherme Venturini"
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
