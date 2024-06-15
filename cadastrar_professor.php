<?php
include 'db.php';
require_once("cabecalho.html");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $departamento = $conn->real_escape_string($_POST['departamento']);
    $titulacao = $conn->real_escape_string($_POST['titulacao']);

    $sql = "INSERT INTO professores (nome, departamento, titulacao) VALUES ('$nome', '$departamento', '$titulacao')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Novo professor cadastrado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="container">
    <h3>Cadastrar Professor</h3>
    <form method="POST" action="cadastrar_professor.php">
        <div class="row">
            <div class="col">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="departamento" class="form-label">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="titulacao" class="form-label">Titulação:</label>
                <input type="text" class="form-control" id="titulacao" name="titulacao" required>
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
require_once("rodape.html");
?>
