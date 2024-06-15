<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM matriculas WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Matrícula excluída com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir matrícula: " . $conn->error . "</div>";
    }
}

$sql = "SELECT m.id, a.nome AS aluno, d.nome AS disciplina FROM matriculas m
        JOIN alunos a ON m.aluno_id = a.id
        JOIN disciplinas d ON m.disciplina_id = d.id";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Matrículas</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Disciplina</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['aluno'] ?></td>
                    <td><?= $row['disciplina'] ?></td>
                    <td>
                        <a href="alterar_matricula.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="listar_matriculas.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhuma matrícula encontrada.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
