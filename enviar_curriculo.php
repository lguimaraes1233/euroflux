<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
        $arquivoTmp = $_FILES['curriculo']['tmp_name'];
        $nomeArquivo = basename($_FILES['curriculo']['name']);
        $destino = 'curriculos/' . $nomeArquivo;

        if (move_uploaded_file($arquivoTmp, $destino)) {

            $mail = new PHPMailer(true);

            try {
                // Configurações do servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'leandrorg307@gmail.com'; // SEU GMAIL
                $mail->Password = 'Novasenha@332022'; // SUA SENHA
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Remetente e destinatário
                $mail->setFrom($email, $nome);
                $mail->addAddress('leandrorg307@gmail.com', 'Leandro');

                // Anexo
                $mail->addAttachment($destino, $nomeArquivo);

                // Conteúdo
                $mail->isHTML(false);
                $mail->Subject = "Novo Currículo de $nome";
                $mail->Body = "Nome: $nome\nEmail: $email\nCurrículo em anexo.";

                $mail->send();
                echo 'Currículo enviado com sucesso!';
            } catch (Exception $e) {
                echo "Erro ao enviar: {$mail->ErrorInfo}";
            }

        } else {
            echo "Erro ao salvar currículo.";
        }
    } else {
        echo "Arquivo inválido.";
    }
}
?>
