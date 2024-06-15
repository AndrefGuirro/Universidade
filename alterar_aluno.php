<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o método da requisição é POST para atualizar os dados do aluno
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $conn->real_escape_string($_POST['nome']);
    $curso = $conn->real_escape_string($_POST['curso']);
    $data_matricula = $conn->real_escape_string($_POST['data_matricula']);

    // SQL para atualizar os dados do aluno
    $sql = "UPDATE alunos SET nome = '$nome', curso = '$curso', data_matricula = '$data_matricula' WHERE id = $id";

    // Executando a query e verificando se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Aluno atualizado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar aluno: " . $conn->error . "</div>";
    }
}

// Verificando se o ID do aluno foi passado na URL para buscar os dados do aluno
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, nome, curso, data_matricula FROM alunos WHERE id = $id";
    $result = $conn->query($sql);

    // Verificando se o aluno foi encontrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Aluno não encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID do aluno não fornecido.</div>";
}
?>

<?php if (isset($row)): ?>
    <div class="container">
        <h3>Alterar Aluno</h3>
        <form method="POST" action="alterar_aluno.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="row">
                <div class="col">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $row['nome'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="curso" class="form-label">Curso:</label>
                    <input type="text" class="form-control" id="curso" name="curso" value="<?= $row['curso'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="data_matricula" class="form-label">Data de Matrícula:</label>
                    <input type="date" class="form-control" id="data_matricula" name="data_matricula" value="<?= $row['data_matricula'] ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success mt-3">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php
// Incluindo o rodapé
require_once("rodape.html");
?>
