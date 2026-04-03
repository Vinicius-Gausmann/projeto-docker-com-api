<?php

header("Content-Type: application/json");

// Conexão com banco
$conn = new mysqli("db", "root", "root", "games_db");

if ($conn->connect_error) {
    die(json_encode(["error" => "Erro de conexão com banco"]));
}

// Captura método
$method = $_SERVER['REQUEST_METHOD'];

// Captura URL corretamente
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$apiPath = array_values(array_filter($requestUri));

// Remove o nome do arquivo da rota
if (isset($apiPath[0]) && $apiPath[0] == 'restfull_api.php') {
    array_shift($apiPath);
}

// ================= ROTAS =================

// GET /games
if ($method == 'GET' && count($apiPath) == 1 && $apiPath[0] == 'games') {

    $result = $conn->query("SELECT * FROM games");

    $games = [];

    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }

    echo json_encode($games);


// POST /games
} elseif ($method == 'POST' && count($apiPath) == 1 && $apiPath[0] == 'games') {

    $input = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("INSERT INTO games (nome, genero, plataforma, ano) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $input["nome"], $input["genero"], $input["plataforma"], $input["ano"]);
    $stmt->execute();

    echo json_encode(["message" => "Jogo criado"]);


// GET /games/{id}
} elseif ($method == 'GET' && count($apiPath) == 2 && $apiPath[0] == 'games') {

    $id = $apiPath[1];

    $stmt = $conn->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $game = $result->fetch_assoc();

    echo $game ? json_encode($game) : json_encode(["error" => "Jogo não encontrado"]);


// PUT /games/{id}
} elseif ($method == 'PUT' && count($apiPath) == 2 && $apiPath[0] == 'games') {

    $id = $apiPath[1];
    $input = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("UPDATE games SET nome=?, genero=?, plataforma=?, ano=? WHERE id=?");
    $stmt->bind_param("sssii", $input["nome"], $input["genero"], $input["plataforma"], $input["ano"], $id);
    $stmt->execute();

    echo json_encode(["message" => "Jogo atualizado"]);


// DELETE /games/{id}
} elseif ($method == 'DELETE' && count($apiPath) == 2 && $apiPath[0] == 'games') {

    $id = $apiPath[1];

    $stmt = $conn->prepare("DELETE FROM games WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["message" => "Jogo deletado"]);


// ERRO
} else {
    echo json_encode(["error" => "Rota não encontrada"]);
}