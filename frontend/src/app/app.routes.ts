import { TableComponent } from '../components/table/table.component';
import { HomeComponent } from '../components/home/home.component';
import { Routes } from '@angular/router';

export const routes: Routes = [
  { path: '', redirectTo: '/cadastro', pathMatch: 'full' },
  { path: 'cadastro', component: HomeComponent },
  { path: 'contatos', component: TableComponent },
  { path: '**', redirectTo: '/cadastro' }
];
