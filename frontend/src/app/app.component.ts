import { Component } from '@angular/core';
import { ContatosComponent } from '../pages/contatos/contatos.component';


@Component({
  selector: 'app-root',
  imports: [ContatosComponent],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'frontend';
}
