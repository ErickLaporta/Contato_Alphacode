import { Component, OnInit } from '@angular/core';
import { Contato } from '../../../types/interfaces';
import { ContatosService } from './../../services/contatos.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-table',
  imports: [CommonModule],
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.css']
})
export class TableComponent implements OnInit {
  contatos: Contato[] = [];

  constructor(private contatosService: ContatosService) { }

  ngOnInit() {
    this.contatosService.listarContatos().subscribe((contatos: Contato[]) => {
      this.contatos = contatos;
    });
  }

  excluirContato(id?: number) {
    if (id) {
      this.contatosService.excluirContato(id).subscribe(() => {
        this.contatos = this.contatos.filter(contato => contato.id !== id);
      });
    }
  }

  editarContato(contato: Contato) {
    this.contatosService.salvarContato(contato);
  }
}
