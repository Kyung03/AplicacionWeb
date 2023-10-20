import { Component, OnInit } from '@angular/core';
import { Location } from '@angular/common';
import { Router, ActivatedRoute } from '@angular/router';
import { UsuarioService } from "../../login/usuario/usuario.service";

@Component({
  selector: 'app-barra-lateral',
  templateUrl: './barra-lateral.component.html',
  styleUrls: ['./barra-lateral.component.css']
})
export class BarraLateralComponent implements OnInit {

  constructor
    (
      private location: Location,
      public router: Router,
      private route: ActivatedRoute,
      public userService: UsuarioService
    ) { }

  usuario_EAF = false;
  usuario_MCC = false;
  usuario_ADM = false;

  ngOnInit(): void {
    this.barra_EAF();
  }

  barra_EAF() {
    switch (this.userService.getTipo()) {
      case 'eaf':
        this.usuario_EAF = true;
        break;
      case 'mcc':
        this.usuario_MCC = true;
        break;
      case 'administrador':
        this.usuario_ADM = true;
        break;
    }
  }
}
