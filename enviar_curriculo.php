<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
        $arquivoTmp = $_FILES['curriculo']['tmp_name'];
        $nomeArquivo = basename($_FILES['curriculo']['name']);
        $destino = 'curriculos/' . $nomeArquivo;

        if (move_uploaded_file($arquivoTmp, $destino)) {
            echo "Currículo enviado com sucesso!";
            // Aqui você pode também enviar por e-mail ou salvar no banco.
        } else {
            echo "Erro ao enviar o currículo.";
        }
    } else {
        echo "Arquivo inválido.";
    }
}
?>
