import { Component, OnInit } from '@angular/core';
import { UsuarioService } from "../../login/usuario/usuario.service";
import { Router } from '@angular/router';
import { EafSerService } from './eafServ/eaf-ser.service';

@Component({
  selector: 'app-eaf-reporte',
  templateUrl: './eaf-mod.component.html',
  styleUrls: ['./eaf-mod.component.css']
})
export class EafReporteComponent implements OnInit {
 
  constructor
  (
    public userService: UsuarioService, 
    public router: Router,
    public eafService:EafSerService
  ) { }

  usuario: string = "";
  tipo: string = "";
  titulo="";
  ngOnInit(): void {
  }
}
