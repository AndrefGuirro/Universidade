<?php
require_once("cabecalho.html");
include 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM professores WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Professor excluído com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir professor: " . $conn->error . "</div>";
    }
}

$sql = "SELECT id, nome, departamento, titulacao FROM professores";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col">
        <h3>Lista de Professores</h3>
    </div>
</div>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-responsive table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Departamento</th>
                <th>Titulação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['departamento'] ?></td>
                    <td><?= $row['titulacao'] ?></td>
                    <td>
                        <a href="alterar_professor.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="listar_professores.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info mt-3">Nenhum professor encontrado.</div>
<?php endif; ?>

<?php
require_once("rodape.html");
?>
