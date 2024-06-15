<?php
require_once("cabecalho.html");
include 'db.php';

// Verificando se existe um ID de exclusão na URL
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM alunos WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Aluno excluído com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir aluno: " . $conn->error . "</div>";
    }
}

// SQL para selecionar todos os alunos
$sql = "SELECT id, nome, curso, data_matricula FROM alunos";
$result = $conn->query($sql);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Lista de Alunos</h3>
        </div>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-responsive table-hover table-striped mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Data de Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nome']) ?></td>
                        <td><?= htmlspecialchars($row['curso']) ?></td>
                        <td><?= htmlspecialchars($row['data_matricula']) ?></td>
                        <td>
                            <a href="alterar_aluno.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="listar_alunos.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info mt-3">Nenhum aluno encontrado.</div>
    <?php endif; ?>
</div>

<?php
require_once("rodape.html");
?>
