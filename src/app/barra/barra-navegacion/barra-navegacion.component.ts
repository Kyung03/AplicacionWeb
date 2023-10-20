import { Component, OnInit } from '@angular/core';
import { UsuarioService } from "../../login/usuario/usuario.service";
import { Router } from '@angular/router';
@Component({
  selector: 'app-barra-navegacion',
  templateUrl: './barra-navegacion.component.html',
  styleUrls: ['./barra-navegacion.component.css']
})
export class BarraNavegacionComponent implements OnInit {

  constructor(public userService: UsuarioService, public router: Router) { }
  usuario_EAF = false;
  usuario_MCC = false;
  usuario_ADM = false;
  modulo = "";
  url_mod = "";
  usuario = "";

  ngOnInit(): void {
    this.barra_EAF();
    this.usuario = this.userService.getUsuario();
  } //  FIN ngOnInit
  
  salir() {
    var resultado = window.confirm(('Estas seguro?'));;
    if (resultado == true) {
      const user = {
        usuario: this.userService.getUsuario(),
        tipo: this.userService.getTipo(),
        token: this.userService.getToken()
      };
      this.userService.cerrar(user).subscribe(resul => {
        switch (resul["msj"]) {
          case '0':
            this.userService.limpiar_cookies();
            alert("Sesión Cerrada");
            this.router.navigate(['/login']);
            break;
          case '1':
            alert("Ha ocurrido un problema");
            break;
        }
      });
    }
  } //  FIN salir

  barra_EAF() {
    switch (this.userService.getTipo()) {
      case 'eaf':
        this.usuario_EAF = true;
        this.modulo = "MÓDULO EAF";
        this.url_mod = "/eaf";
        break;
      case 'mcc':
        this.usuario_MCC = true;
        this.modulo = "MÓDULO MCC";
        this.url_mod = "/mcc";
        break;
      case 'administrador':
        this.usuario_ADM = true;
        this.modulo = "MÓDULO ADMIN";
        this.url_mod = "/adm";
        break;
    }
  } //  FIN barra_EAF

}
