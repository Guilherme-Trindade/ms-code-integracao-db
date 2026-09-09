# Integração PHP + MySQL com PDO

Projeto de estudo da disciplina **Integração com Banco de Dados**, com exemplos práticos de como manipular dados de um banco **MySQL** usando **PHP** e a extensão **PDO**.

O arquivo principal (`index.php`) traz o passo a passo completo de conexão e das quatro operações do CRUD — **C**reate, **R**ead, **U**pdate, **D**elete — prontos para você estudar, descomentar e testar.

---

## 📋 Pré-requisitos

Antes de rodar o projeto, você precisa ter instalado:

- **PHP** 8.0 ou superior (o projeto usa `mixed` como tipo de parâmetro, disponível a partir do PHP 8)
- **MySQL** (ou MariaDB) rodando localmente ou via Docker
- Um servidor web local — **XAMPP**, **Laragon**, **PHP embutido** (`php -S`)
- Extensão `pdo_mysql` habilitada no PHP

---

## 🗄️ Estrutura do banco de dados

O script espera um banco chamado `mscode` com uma tabela `alunos`. Crie o banco e a tabela antes de rodar o projeto, além disso tem o arquivo com o banco de dados que vou disponibilizar para uso de vocês, sabendo disso o nome do banco e tabela podem mudar, mas vcs precisam prestar atenção nessa alteração:

```sql
CREATE DATABASE IF NOT EXISTS mscode;

USE mscode;

CREATE TABLE IF NOT EXISTS alunos (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(150) NOT NULL,
    country VARCHAR(100) NOT NULL,
    email   VARCHAR(150) NULL
);

-- Um registro de exemplo para testar o SELECT
INSERT INTO alunos (name, country) VALUES ('Maria Silva', 'Brazil');
```

---

## ⚙️ Configuração da conexão

No topo do arquivo `index.php`, ajuste as credenciais de acordo com o seu ambiente:

```php
$host = 'db';        // Use 'localhost' se estiver rodando fora do Docker
$db   = 'mscode';     // Nome do banco de dados
$user = 'guilherme';  // Seu usuário do MySQL
$pass = 'guilherme';  // Sua senha do MySQL
$port = '3306';       // Porta padrão do MySQL
```

> ⚠️ **Atenção:** o valor `'db'` no `$host` é o nome do serviço usado quando o banco roda dentro de um container Docker (`docker-compose`). Se você estiver rodando o MySQL diretamente na sua máquina (XAMPP, Laragon, instalação local), troque para `'localhost'`.

---

## ▶️ Como rodar o projeto

**Opção 1 — Servidor embutido do PHP**

```bash
php -S localhost:8000
```

Depois acesse [http://localhost:8000](http://localhost:8000) no navegador.

**Opção 2 — XAMPP / Laragon**

Coloque a pasta do projeto dentro de `htdocs` (XAMPP) ou `www` (Laragon) e acesse pelo navegador normalmente.

**Opção 3 — Docker**

Se o seu `$host` está como `'db'`, o projeto espera um `docker-compose.yml` com um serviço de banco de dados chamado `db`. Suba os containers com:

```bash
docker-compose up -d
```

---

## 🧠 Entendendo o código

### Função `dd()`

```php
function dd(mixed $valor)
{
    echo '<pre>';
    print_r($valor);
    echo '</pre>';
}
```

Uma função auxiliar de **debug** ("dump and die" simplificado). Use `dd($variavel)` a qualquer momento para imprimir o conteúdo de uma variável de forma legível — muito útil para inspecionar o que veio do banco.

### Conexão com PDO

```php
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $options);
```

A conexão é feita através de uma **DSN** (*Data Source Name*), que descreve driver, host, porta, banco e codificação em uma única string.

### O array `$options`

```php
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
```

| Opção | O que faz |
|---|---|
| `ATTR_ERRMODE` → `ERRMODE_EXCEPTION` | Faz o PDO lançar exceções em vez de falhar silenciosamente — assim conseguimos tratar erros com `try/catch`. |
| `ATTR_DEFAULT_FETCH_MODE` → `FETCH_ASSOC` | Faz cada linha retornar como array associativo (`$linha['nome']`) em vez de array numérico. |
| `ATTR_EMULATE_PREPARES` → `false` | Desativa a emulação de prepared statements do PHP, deixando o **próprio MySQL** validar e executar os parâmetros. É essencial para segurança real contra SQL Injection e para melhor performance. |

---

## 🔁 O CRUD passo a passo

As quatro operações estão no arquivo, **comentadas em bloco** (`// ...`). Isso é proposital: **descomente um bloco por vez** para testar cada operação isoladamente, sem que uma interfira na outra.

| Operação | O que faz | Onde está no arquivo |
|---|---|---|
| **Read** (Ler) | Busca alunos do Brasil com `SELECT` | Bloco `##### Read(Ler)` |
| **Create** (Criar) | Insere um novo aluno com `INSERT` usando *prepared statements* | Bloco `##### Create(Criar)` |
| **Update** (Atualizar) | Atualiza o e-mail de um aluno existente com `UPDATE` | Bloco `##### Update(Atualizar)` |
| **Delete** (Excluir) | Remove um aluno com `DELETE` | Bloco `##### Delete(Excluir)` |

### Como testar cada bloco

1. Abra `index.php`.
2. Escolha o bloco que quer testar (por exemplo, `Create`).
3. Remova as barras `//` do início de cada linha daquele bloco.
4. Salve e recarregue a página no navegador.
5. Veja o resultado impresso no `<body>` da página (lista de nome, país e e-mail) e a mensagem de sucesso.
6. Comente o bloco novamente antes de testar o próximo, para não misturar os resultados.

> 💡 **Dica:** todos os blocos usam **prepared statements** com parâmetros nomeados (`:name`, `:pais`, `:email`, `:id`) — isso é o que protege o código contra **SQL Injection**. Nunca substitua isso por concatenação direta de strings no SQL.

---

## 🖥️ Exibindo os resultados

No final do arquivo, o HTML percorre o array `$dados` (preenchido pelo bloco de CRUD que você descomentou) e imprime cada aluno na tela:

```php
<?php foreach ($dados as $dado) { ?>
    <p><?= $dado['name'] . ' - ' . $dado['country'] . ' - ' . $dado['email'] ?></p>
<?php } ?>
```

Se `$dados` estiver vazio (nenhum bloco descomentado, ou nenhum resultado encontrado), nada será exibido na tela — isso é esperado.

---

## ✅ Checklist antes de rodar

- [ ] Banco `mscode` e tabela `alunos` criados
- [ ] Credenciais (`$host`, `$db`, `$user`, `$pass`, `$port`) ajustadas para o seu ambiente
- [ ] Apenas **um** bloco de CRUD descomentado por vez
- [ ] Servidor PHP rodando e apontando para a pasta do projeto

---

## 🎯 Exercícios sugeridos

1. Descomente o bloco **Read** e altere o `WHERE` para buscar alunos de outro país.
2. Descomente o bloco **Create** e insira um novo aluno com seus próprios dados.
3. Descomente o bloco **Update** e altere o e-mail do aluno que você acabou de criar.
4. Descomente o bloco **Delete** e remova o registro criado — depois confirme que o `SELECT` seguinte retorna vazio.
5. **Desafio:** transforme o `WHERE` fixo do bloco `Read` em um filtro dinâmico, recebendo o país por `$_GET['country']` — sem esquecer de usar *prepared statements* para o parâmetro.

---

## 📚 Referências

- [Documentação oficial do PDO — PHP Manual](https://www.php.net/manual/pt_BR/book.pdo.php)
- [PDO Prepared Statements](https://www.php.net/manual/pt_BR/pdo.prepared-statements.php)
