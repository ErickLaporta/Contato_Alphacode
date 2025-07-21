<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/../controllers/ContatosController.php';

class ContatosRoutes {
    private $controller;

    public function __construct() {
        $conn = require_once __DIR__ . '/../../../config/conexao.php';
        require_once __DIR__ . '/../models/ContatosModels.php';
        
        $model = new ContatosModels($conn);
        $this->controller = new ContatosController($model);
    }

    public function solicitarRotas() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        header('Content-Type: application/json');

        if ($method === 'OPTIONS') {
         http_response_code(200);
         return;
        }
        
        if ($method === 'GET' && $uri === '/contatos') {
            $resultado = $this->controller->listarContatos();
            echo json_encode($resultado);
            return;
        } else if ($method === 'POST' && $uri === '/contatos') {
            $input = json_decode(file_get_contents('php://input'), true);
            $resultado = $this->controller->cadastrarContato($input);
            echo json_encode($resultado);
            return;
        } else if ($method === 'PUT' && preg_match('/\/contatos\/(\d+)/', $uri, $matches)) {
            $input = json_decode(file_get_contents('php://input'), true);
            $resultado = $this->controller->editarContato($matches[1], $input);
            echo json_encode($resultado);
            return;
        } else if ($method === 'DELETE' && preg_match('/\/contatos\/(\d+)/', $uri, $matches)) {
            $resultado = $this->controller->excluirContato($matches[1]);
            echo json_encode($resultado);
            return;
        } else {
            http_response_code(404);
        }
    }
}

?>