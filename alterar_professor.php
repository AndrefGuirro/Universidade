<?php
// Incluindo a conexão com o banco de dados e o cabeçalho
include 'db.php';
require_once("cabecalho.html");

// Verificando se o método da requisição é POST para atualizar os dados do professor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $conn->real_escape_string($_POST['nome']);
    $departamento = $conn->real_escape_string($_POST['departamento']);

    // SQL para atualizar os dados do professor
    $sql = "UPDATE professores SET nome = '$nome', departamento = '$departamento' WHERE id = $id";

    // Executando a query e verificando se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Professor atualizado com sucesso</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar professor: " . $conn->error . "</div>";
    }
}

// Verificando se o ID do professor foi passado na URL para buscar os dados do professor
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, nome, departamento FROM professores WHERE id = $id";
    $result = $conn->query($sql);

    // Verificando se o professor foi encontrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div class="container">
            <h3>Alterar Professor</h3>
            <form method="POST" action="alterar_professor.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="row">
                    <div class="col">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $row['nome'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" value="<?= $row['departamento'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mt-3">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
<?php
    } else {
        echo "<div class='alert alert-danger'>Professor não encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID do professor não fornecido.</div>";
}

// Incluindo o rodapé
require_once("rodape.html");
?>
