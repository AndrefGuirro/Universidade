<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o ID da matrícula foi passado via GET
if (isset($_GET['id'])) {
    $matricula_id = $_GET['id'];

    // Consulta SQL para obter os detalhes da matrícula
    $sql = "SELECT m.id as matricula_id, a.id as aluno_id, a.nome as aluno_nome, d.id as disciplina_id, d.codigo as disciplina_codigo
            FROM matriculas m
            INNER JOIN alunos a ON m.aluno_id = a.id
            INNER JOIN disciplinas d ON m.disciplina_id = d.id
            WHERE m.id = $matricula_id";

    $result = $conn->query($sql);

    // Verificando se encontrou a matrícula com o ID fornecido
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div class="container">
            <h3>Alterar Matrícula</h3>
            <form method="POST" action="processar_alteracao_matricula.php">
                <input type="hidden" name="matricula_id" value="<?= $row['matricula_id'] ?>">
                <div class="row">
                    <div class="col">
                        <label for="aluno_id" class="form-label">Aluno:</label>
                        <input type="text" class="form-control" id="aluno_id" name="aluno_id" value="<?= $row['aluno_nome'] ?>" readonly>
                        <input type="hidden" name="aluno_id" value="<?= $row['aluno_id'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="disciplina_id" class="form-label">Disciplina:</label>
                        <input type="text" class="form-control" id="disciplina_id" name="disciplina_id" value="<?= $row['disciplina_codigo'] ?>" readonly>
                        <input type="hidden" name="disciplina_id" value="<?= $row['disciplina_id'] ?>">
                    </div>
                </div>
                <!-- Aqui você pode adicionar campos adicionais da matrícula, como data de matrícula, status, etc. -->
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="listar_matriculas.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
<?php
    } else {
        echo "<div class='alert alert-danger'>Nenhuma matrícula encontrada com o ID fornecido.</div>";
    }

    // Liberar o resultado da consulta
    $result->free();
} else {
    echo "<div class='alert alert-danger'>ID da matrícula não fornecido para alteração.</div>";
}

// Incluindo o rodapé da página
require_once("rodape.html");

// Fechar a conexão com o banco de dados
$conn->close();
?>
