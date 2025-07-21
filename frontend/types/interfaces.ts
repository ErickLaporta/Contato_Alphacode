export interface Contato {
    id?: number;
    nome: string;
    email: string;
    telefone: string;
    celular: string;
    profissao: string;
    nascimento: string;
    whatsapp?: number;
    sms?: number;
    notificarEmail?: number;
}