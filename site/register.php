<?php

require_once "check_signin.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atribuição condicional para evitar erros de variáveis indefinidas
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $errors = [];

    if (empty($username)) $errors['error_user'] = "Preencha o campo de Usuário";
    if (empty($password)) $errors['error_pass'] = "Preencha o campo de Senha";
    if (empty($email)) $errors['error_email'] = "Preencha o campo de Email";

    if (!empty($errors)) {
        echo json_encode($errors); // Enviar todos os erros de uma vez
        exit(); // Finaliza a execução após enviar os erros
    }

    $user_register = new User_Register();

    $result = $user_register->register($username, $password, $email);
    if (strlen($result) == 0) $result = "Cadastro realizado com sucesso";

    echo json_encode(['success' => "$result"]);
} else {
    echo json_encode(['error' => 'Formulário não processado!']);

    exit();
}
