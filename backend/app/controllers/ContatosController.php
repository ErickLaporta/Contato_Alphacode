<?php

require_once __DIR__ . '/../models/ContatosModels.php';

class ContatosController {
    private $contatoModel;

    public function __construct($contatoModel) {
        $this->contatoModel = $contatoModel;
    }

    public function validarDados($dados) {
        switch (true) {
            case ($dados["nome"] === "" || strlen($dados["nome"]) < 3):
                return "O nome deve ter pelo menos 3 caracteres.";
            case ($dados["email"] === "" || !filter_var($dados["email"], FILTER_VALIDATE_EMAIL)):
                return "O e-mail é inválido.";
            case ($dados["telefone"] === "" || strlen($dados["telefone"]) !== 10):
                return "O telefone deve conter 10 dígitos.";
            case ($dados["celular"] === "" || strlen($dados["celular"]) !== 11):
                return "O celular deve conter 11 dígitos.";
            case ($dados["profissao"] === "" || strlen($dados["profissao"]) < 3):
                return "A profissão deve ter pelo menos 3 caracteres.";
            case ($dados["nascimento"] === ""):
                return "A data de nascimento deve conter dia, mês e ano por extenso.";
            case !is_numeric($dados["whatsapp"]) || !is_numeric($dados["sms"]) || !is_numeric($dados["notificarEmail"]):
                return "Os campos WhatsApp, SMS e Notificar Email devem ser 0 ou 1.";
            default:
                return null;
        }
    }

    public function cadastrarContato($dados) {        
        return $this->contatoModel->cadastrarContato($dados);
    }

    public function editarContato($id, $dados) {
        $erro = $this->validarDados($dados);
        if ($erro) return $erro;

        return $this->contatoModel->editarContato($id, $dados);
    }

    public function listarContatos() {
        return $this->contatoModel->listarContatos();
    }

    public function excluirContato($id) {
        if (!is_numeric($id) || $id < 0) return "ID inválido.";

        return $this->contatoModel->excluirContato($id);
    }
}

?>