<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM disciplinas WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Disciplina excluída com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir disciplina: " . $conn->error . "</div>";
    }
}

$sql = "SELECT d.id, d.codigo, d.nome, p.nome AS professor FROM disciplinas d LEFT JOIN professores p ON d.professor_id = p.id";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Disciplinas</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Professor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['codigo'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['professor'] ?></td>
                    <td>
                        <a href="alterar_disciplina.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="listar_disciplinas.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhuma disciplina encontrada.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
