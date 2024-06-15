<?php
include 'db.php';
require_once("cabecalho.html");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $disciplina_id = $_POST['disciplina_id'];

    $sql = "INSERT INTO matriculas (aluno_id, disciplina_id) VALUES ('$aluno_id', '$disciplina_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Nova matrícula cadastrada com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$sql_alunos = "SELECT id, nome FROM alunos";
$result_alunos = $conn->query($sql_alunos);

$sql_disciplinas = "SELECT id, codigo FROM disciplinas";
$result_disciplinas = $conn->query($sql_disciplinas);
?>

<h3>Cadastrar Matrícula</h3>
<form method="POST" action="cadastrar_matricula.php">
    <div class="row">
        <div class="col">
            <label for="aluno_id" class="form-label">Aluno:</label>
            <select class="form-select" id="aluno_id" name="aluno_id" required>
                <?php while ($row = $result_alunos->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="disciplina_id" class="form-label">Disciplina:</label>
            <select class="form-select" id="disciplina_id" name="disciplina_id" required>
                <?php while ($row = $result_disciplinas->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['codigo'] ?></option>
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

<?php
require_once("rodape.html");
?>
