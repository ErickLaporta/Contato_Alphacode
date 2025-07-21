import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { ContatosService } from '../../services/contatos.service';
import { CommonModule } from '@angular/common';
import { Contato } from '../../../types/interfaces';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-home',
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  contatoForm!: FormGroup;
  contato: Contato | null = null;
  private preencherContato!: Subscription;

  constructor(
    private service: ContatosService,
    private formBuilder: FormBuilder,
  ) { }

  ngOnInit(): void {
    this.contatoForm = this.formBuilder.group({
      nome: [''],
      email: [''],
      telefone: [''],
      celular: [''],
      profissao: [''],
      nascimento: [''],
      whatsapp: [false],
      sms: [false],
      notificarEmail: [false],
    });

    this.preencherContato = this.service.contato$.subscribe(contato => {
      this.contato = contato;
      if (contato) {
        this.contatoForm.patchValue(contato);
      } else {
        this.contatoForm.reset(); 
      }
    });
  }

  onSubmit() {
    const form = this.contatoForm.value;

    if (form.whatsapp || form.sms || form.notificarEmail) {
      form.whatsapp = form.whatsapp ? 1 : 0;
      form.sms = form.sms ? 1 : 0;
      form.notificarEmail = form.notificarEmail ? 1 : 0;
    }

    if (this.contato && this.contato.id !== undefined) {
      this.service.atualizarContato(this.contato.id, form).subscribe(() => {
        this.contatoForm.reset();
        this.service.salvarContato(null);
        window.location.reload();
      });
    } else {
      this.service.cadastrarContato(form).subscribe(() => {
        this.contatoForm.reset();
        window.location.reload();
      });
    }
  }
}
