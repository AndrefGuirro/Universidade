<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapando os dados enviados pelo formulário para evitar SQL Injection
    $nome = $conn->real_escape_string($_POST['nome']);
    $curso = $conn->real_escape_string($_POST['curso']);
    $data_matricula = $conn->real_escape_string($_POST['data_matricula']);

    // SQL para inserir um novo aluno
    $sql = "INSERT INTO alunos (nome, curso, data_matricula) VALUES ('$nome', '$curso', '$data_matricula')";

    // Executando a query e verificando se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Novo aluno cadastrado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="container">
    <h3>Cadastrar Aluno</h3>
    <form method="POST" action="cadastrar_aluno.php">
        <div class="row">
            <div class="col">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="curso" class="form-label">Curso:</label>
                <input type="text" class="form-control" id="curso" name="curso" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="data_matricula" class="form-label">Data de Matrícula:</label>
                <input type="date" class="form-control" id="data_matricula" name="data_matricula" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success mt-3">Cadastrar</button>
            </div>
        </div>
    </form>
</div>

<?php
// Incluindo o rodapé
require_once("rodape.html");
?>
