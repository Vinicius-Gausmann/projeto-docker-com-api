<?php

header("Content-Type: application/json");

// Arquivo JSON que simula um banco de dados
const DB_FILE = "db.json";

// Carrega dados do "banco"
function loadData() {
    return file_exists(DB_FILE) ? json_decode(file_get_contents(DB_FILE), true) : [];
}

// Salva dados no "banco"
function saveData($data) {
    file_put_contents(DB_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

// Obtém a requisição
$method = $_SERVER['REQUEST_METHOD'];
$path = isset($_GET['path']) ? explode('/', trim($_GET['path'], '/')) : [];

// Carrega os dados atuais
$data = loadData();

// Rotas para gerenciar "jogos"
if ($method == 'GET' && count($path) == 1 && $path[0] == 'games') {
    echo json_encode($data);

} elseif ($method == 'POST' && count($path) == 1 && $path[0] == 'games') {
    $input = json_decode(file_get_contents("php://input"), true);

    $id = uniqid();
    $data[$id] = [
        "nome" => $input["nome"] ?? "",
        "genero" => $input["genero"] ?? "",
        "plataforma" => $input["plataforma"] ?? "",
        "ano" => $input["ano"] ?? ""
    ];

    saveData($data);
    echo json_encode(["message" => "Jogo criado", "id" => $id]);

} elseif ($method == 'GET' && count($path) == 2 && $path[0] == 'games') {
    $id = $path[1];

    echo isset($data[$id]) 
        ? json_encode($data[$id]) 
        : json_encode(["error" => "Jogo não encontrado"]);

} elseif ($method == 'PUT' && count($path) == 2 && $path[0] == 'games') {
    $id = $path[1];

    if (isset($data[$id])) {
        $input = json_decode(file_get_contents("php://input"), true);

        $data[$id] = [
            "nome" => $input["nome"] ?? $data[$id]["nome"],
            "genero" => $input["genero"] ?? $data[$id]["genero"],
            "plataforma" => $input["plataforma"] ?? $data[$id]["plataforma"],
            "ano" => $input["ano"] ?? $data[$id]["ano"]
        ];

        saveData($data);
        echo json_encode(["message" => "Jogo atualizado"]);
    } else {
        echo json_encode(["error" => "Jogo não encontrado"]);
    }

} elseif ($method == 'DELETE' && count($path) == 2 && $path[0] == 'games') {
    $id = $path[1];

    if (isset($data[$id])) {
        unset($data[$id]);
        saveData($data);
        echo json_encode(["message" => "Jogo deletado"]);
    } else {
        echo json_encode(["error" => "Jogo não encontrado"]);
    }

} else {
    echo json_encode(["error" => "Rota não encontrada"]);
}