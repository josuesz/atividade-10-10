<?php
// 1. Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vendas"; // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
echo "Conexão realizada com sucesso!<br>";

// 2. Criar a tabela duplicata
$sql = "CREATE TABLE IF NOT EXISTS duplicata (
    Nome CHAR(40),
    Numero INT NOT NULL PRIMARY KEY,
    Valor DECIMAL(10, 2),
    Vencimento DATE,
    Banco CHAR(10)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela duplicata criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela: " . $conn->error . "<br>";
}

// 3. Inserir os dados na tabela duplicata
$sql_insert = "INSERT INTO duplicata (Nome, Numero, Valor, Vencimento, Banco) VALUES
('ABC PAPELARIA', 100100, 5000.00, '2017-01-20', 'ITAU'),
('LIVRARIA FERNANDES', 100110, 2500.00, '2017-01-22', 'ITAU'),
('LIVRARIA FERNANDES', 100120, 1500.00, '2016-10-15', 'BRADESCO'),
('ABC PAPELARIA', 100130, 8000.00, '2016-10-15', 'SANTANDER'),
('LER E SABER', 200120, 10500.00, '2018-04-26', 'BANCO DO BRASIL'),
('LIVROS E CIA', 200125, 2000.00, '2018-04-26', 'BANCO DO BRASIL'),
('LER E SABER', 200130, 11000.00, '2018-09-26', 'ITAU'),
('PAPELARIA SILVA', 250350, 1500.00, '2018-01-26', 'BRADESCO'),
('LIVROS MM', 250360, 500.00, '2018-12-18', 'SANTANDER'),
('LIVROS MM', 250370, 3400.00, '2018-04-26', 'SANTANDER'),
('PAPELARIA SILVA', 250380, 3500.00, '2018-04-26', 'BANCO DO BRASIL'),
('LIVROS E CIA', 453360, 1500.00, '2018-06-15', 'ITAU'),
('LIVROS MM', 453365, 5400.00, '2018-06-15', 'BRADESCO'),
('PAPELARIA SILVA', 453370, 2350.00, '2017-12-27', 'ITAU'),
('LIVROS E CIA', 453380, 1550.00, '2017-12-27', 'BANCO DO BRASIL'),
('ABC PAPELARIA', 980130, 4000.00, '2016-12-11', 'ITAU'),
('LIVRARIA FERNANDES', 770710, 2500.00, '2016-11-15', 'SANTANDER'),
('ABC PAPELARIA', 985001, 3000.00, '2016-09-11', 'ITAU'),
('PAPEL E AFINS', 985002, 2500.00, '2016-03-12', 'SANTANDER'),
('LER E SABER', 888132, 2500.00, '2017-03-05', 'ITAU')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Dados inseridos com sucesso!<br>";
} else {
    echo "Erro ao inserir os dados: " . $conn->error . "<br>";
}

// 4. Consultas SQL

// a) Exibir Nome, Vencimento e Valor
$sql_select = "SELECT Nome, Vencimento, Valor FROM duplicata";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<br>Duplicatas (Nome, Vencimento, Valor):<br>";
    while($row = $result->fetch_assoc()) {
        echo "Nome: " . $row["Nome"]. " - Vencimento: " . $row["Vencimento"]. " - Valor: " . $row["Valor"]. "<br>";
    }
} else {
    echo "Nenhuma duplicata encontrada.<br>";
}

// b) Selecionar duplicatas do banco 'ITAU'
$sql_itaus = "SELECT Numero FROM duplicata WHERE Banco = 'ITAU'";
$result = $conn->query($sql_itaus);

if ($result->num_rows > 0) {
    echo "<br>Números de duplicatas no banco ITAU:<br>";
    while($row = $result->fetch_assoc()) {
        echo "Número: " . $row["Numero"] . "<br>";
    }
} else {
    echo "Nenhuma duplicata encontrada no banco ITAU.<br>";
}

// c) Contar quantas duplicatas são do banco 'ITAU'
$sql_count_itaus = "SELECT COUNT(*) AS Total_Itaú FROM duplicata WHERE Banco = 'ITAU'";
$result = $conn->query($sql_count_itaus);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<br>Total de duplicatas no banco ITAU: " . $row["Total_Itaú"] . "<br>";
} else {
    echo "Erro na contagem de duplicatas do banco ITAU.<br>";
}

// d) Selecionar duplicatas com vencimento em 2017
$sql_vencimento_2017 = "SELECT Numero, Vencimento, Valor, Nome FROM duplicata WHERE YEAR(Vencimento) = 2017";
$result = $conn->query($sql_vencimento_2017);

if ($result->num_rows > 0) {
    echo "<br>Duplicatas com vencimento em 2017:<br>";
    while($row = $result->fetch_assoc()) {
        echo "Número: " . $row["Numero"] . " - Vencimento: " . $row["Vencimento"] . " - Valor: " . $row["Valor"] . " - Nome: " . $row["Nome"] . "<br>";
    }
} else {
    echo "Nenhuma duplicata com vencimento em 2017 encontrada.<br>";
}

// e) Selecionar duplicatas com banco diferente de 'ITAU' ou 'SANTANDER'
$sql_bancos_diferentes = "SELECT Numero, Vencimento, Valor, Nome FROM duplicata WHERE Banco NOT IN ('ITAU', 'SANTANDER')";
$result = $conn->query($sql_bancos_diferentes);

if ($result->num_rows > 0) {
    echo "<br>Duplicatas com banco diferente de 'ITAU' ou 'SANTANDER':<br>";
    while($row = $result->fetch_assoc()) {
        echo "Número: " . $row["Numero"] . " - Vencimento: " . $row["Vencimento"] . " - Valor: " . $row["Valor"] . " - Nome: " . $row["Nome"] . "<br>";
    }
} else {
    echo "Nenhuma duplicata com banco diferente de ITAU ou SANTANDER encontrada.<br>";
}

// 5. Fechar a conexão
$conn->close();
?>
