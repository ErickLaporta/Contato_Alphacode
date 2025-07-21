import { Component } from '@angular/core';
import { HeaderComponent } from "../../components/header/header.component";
import { HomeComponent } from "../../components/home/home.component";
import { TableComponent } from "../../components/table/table.component";
import { FooterComponent } from "../../components/footer/footer.component";

@Component({
  selector: 'app-contatos',
  imports: [HeaderComponent, HomeComponent, TableComponent, FooterComponent],
  templateUrl: './contatos.component.html',
  styleUrl: './contatos.component.css'
})
export class ContatosComponent {

}
