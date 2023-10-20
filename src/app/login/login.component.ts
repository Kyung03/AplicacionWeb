import { Component, OnInit } from '@angular/core';
import { UsuarioService } from "./usuario/usuario.service";
import { Router } from '@angular/router';
import { ModalService } from '../modulo/modal/modal.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  usuario: string = "";
  password: string = "";

  constructor(
    public userService: UsuarioService,
    public router: Router,
    private modalService: ModalService
  ) { }

  ngOnInit(): void {
  } // FIN ngOnInit

  open(datos: any) {
    this.modalService.open(datos);
  } // FIN open

  login() {
    const user = { usuario: this.usuario, password: this.password, verificacion: false };
    this.userService.ingresar(user).subscribe(resul => {
      switch (resul["resultado"]) {
        // NUEVA SESION
        case '3':
          // cookies 
          this.userService.setToken(resul['tokken']);
          this.userService.setUsuario(resul['usuario']);
          this.userService.setTipo(resul['tipo']);
          // local storage
          this.userService.setTokenLS(resul['tokken']);
          // re direccion 
          alert(resul["mensaje"]);
          this.router.navigate(['/' + resul["modulo"]]);
          break;
        // SESION INICIADA
        case '4':
          this.open(user);
          break;
        // OPERACION FALLIDA
        default:
          alert('OPERACION FALLIDA ' + resul["mensaje"]);
          break;
      }
    });
  } // FIN login

}
