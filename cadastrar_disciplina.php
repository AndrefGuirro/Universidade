<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapando os dados enviados pelo formulário para evitar SQL Injection
    $codigo = $conn->real_escape_string($_POST['codigo']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $professor_id = $conn->real_escape_string($_POST['professor_id']);

    // SQL para inserir uma nova disciplina
    $sql = "INSERT INTO disciplinas (codigo, nome, professor_id) VALUES ('$codigo', '$nome', '$professor_id')";

    // Executando a query e verificando se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Nova disciplina cadastrada com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// SQL para selecionar todos os professores
$sql_professores = "SELECT id, nome FROM professores";
$result_professores = $conn->query($sql_professores);
?>

<div class="container">
    <h3>Cadastrar Disciplina</h3>
    <form method="POST" action="cadastrar_disciplina.php">
        <div class="row">
            <div class="col">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="nome" class="form-label">Nome da Disciplina:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="professor_id" class="form-label">Professor Responsável:</label>
                <select class="form-select" id="professor_id" name="professor_id" required>
                    <?php while ($row = $result_professores->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
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
