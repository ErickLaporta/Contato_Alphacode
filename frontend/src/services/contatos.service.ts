import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Contato } from '../../types/interfaces';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ContatosService {

  private API_URL = 'http://localhost:8000/contatos';
  private contatoSubject = new BehaviorSubject<Contato | null>(null);
  contato$ = this.contatoSubject.asObservable();

  constructor(private httpClient: HttpClient) { }

  listarContatos(): Observable<Contato[]> {
    return this.httpClient.get<Contato[]>(this.API_URL);
  }

  cadastrarContato(novoContato: Contato): Observable<Contato> {
    return this.httpClient.post<Contato>(this.API_URL, novoContato);
  }

  excluirContato(id: number): Observable<void> {
    return this.httpClient.delete<void>(`${this.API_URL}/${id}`);
  }

  atualizarContato(id: number, contato: Contato): Observable<Contato> {
    return this.httpClient.put<Contato>(`${this.API_URL}/${id}`, contato);
  }

  salvarContato(contato: Contato | null) {
    this.contatoSubject.next(contato);
  }
}
