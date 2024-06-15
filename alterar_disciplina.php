<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o parâmetro GET 'id' foi fornecido na URL
if (isset($_GET['id'])) {
    $disciplina_id = $_GET['id'];

    // Consulta SQL para selecionar a disciplina com o ID fornecido
    $sql = "SELECT id, codigo, professor_id FROM disciplinas WHERE id = $disciplina_id";

    // Executar a consulta e verificar se houve erros
    $result = $conn->query($sql);
    if (!$result) {
        echo "Erro na consulta: " . $conn->error;
    }

    // Verificando se encontrou alguma disciplina com o ID fornecido
    if ($result->num_rows > 0) {
        // Exibir o formulário de alteração com os dados da disciplina
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $codigo = $row['codigo'];
            $professor_id = $row['professor_id'];
?>
            <div class="container">
                <h3>Alterar Disciplina</h3>
                <form method="POST" action="processar_alteracao_disciplina.php">
                    <input type="hidden" name="disciplina_id" value="<?= $id ?>">
                    <div class="row">
                        <div class="col">
                            <label for="codigo" class="form-label">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $codigo ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="professor_id" class="form-label">Professor Responsável:</label>
                            <select class="form-select" id="professor_id" name="professor_id" required>
                                <?php
                                // Consulta para obter os professores disponíveis
                                $sql_professores = "SELECT id, nome FROM professores";
                                $result_professores = $conn->query($sql_professores);
                                if ($result_professores->num_rows > 0) {
                                    while ($row_professor = $result_professores->fetch_assoc()) {
                                        $selected = ($professor_id == $row_professor['id']) ? 'selected' : '';
                                        echo "<option value='{$row_professor['id']}' $selected>{$row_professor['nome']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
                            <a href="listar_disciplinas.php" class="btn btn-secondary mt-3">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
<?php
        }
    } else {
        echo "Nenhuma disciplina encontrada com o ID fornecido.";
    }

    // Liberar o resultado da consulta
    $result->free();
} else {
    echo "ID da disciplina não fornecido para alteração.";
}

// Incluindo o rodapé
require_once("rodape.html");

// Fechar a conexão com o banco de dados
$conn->close();
?>
