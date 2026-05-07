<?php require_once 'classes.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro - IFTO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">IFTO</div>
            <h1>Cadastro</h1>
        </header>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" id="nome" required placeholder="Ex: Marcos Raimundo">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00">
            </div>
            
            <div class="form-group">
                <label for="tipo">Tipo de Frequentador</label>
                <select name="tipo" id="tipo" onchange="toggleFields()" required>
                    <option value="estudante">Estudante</option>
                    <option value="professor">Professor</option>
                    <option value="servidor">Servidor</option>
                    <option value="visitante">Visitante</option>
                </select>
            </div>

            <!-- Campos Dinâmicos -->
            <div id="campo_curso" class="extra-fields">
                <div class="form-group">
                    <label for="curso">Curso</label>
                    <input type="text" name="curso" placeholder="Ex: Sistemas de Informação">
                </div>
            </div>

            <div id="campos_financeiros" class="extra-fields" style="display:none;">
                <div class="form-group">
                    <label for="funcao">Função / Cargo</label>
                    <input type="text" name="funcao" placeholder="Ex: Coordenador">
                </div>
                <div class="form-group">
                    <label for="salario">Salário (R$)</label>
                    <input type="number" step="0.01" name="salario" placeholder="Ex: 5000.00">
                </div>
            </div>

            <button type="submit" class="btn-submit">Cadastrar no Sistema</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'] ?? '';
            $cpf = $_POST['cpf'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            $p = null;

            try {
                switch ($tipo) {
                    case 'estudante':
                        $p = new Estudante($nome, $cpf, $_POST['curso'] ?? '');
                        break;
                    case 'professor':
                        $p = new Professor($nome, $cpf, $_POST['funcao'] ?? '', $_POST['salario'] ?? 0);
                        break;
                    case 'servidor':
                        $p = new Servidor($nome, $cpf, $_POST['funcao'] ?? '', $_POST['salario'] ?? 0);
                        break;
                    case 'visitante':
                        $p = new Visitante($nome, $cpf);
                        break;
                }

                if ($p) {
                    echo '<div class="resultado success">';
                    echo '<h3>Cadastro Realizado com Sucesso!</h3>';
                    echo '<p>' . $p->exibirDados() . '</p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                echo '<div class="resultado error">Erro ao processar cadastro.</div>';
            }
        }
        ?>
    </div>

    <script>
        function toggleFields() {
            const tipo = document.getElementById('tipo').value;
            const campoCurso = document.getElementById('campo_curso');
            const camposFinan = document.getElementById('campos_financeiros');

            // Reset visibility
            campoCurso.style.display = 'none';
            camposFinan.style.display = 'none';

            if (tipo === 'estudante') {
                campoCurso.style.display = 'block';
            } else if (tipo === 'professor' || tipo === 'servidor') {
                camposFinan.style.display = 'block';
            }
        }
    </script>
</body>
</html>