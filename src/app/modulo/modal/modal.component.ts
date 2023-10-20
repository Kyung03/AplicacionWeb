import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { ModalService } from '../modal/modal.service';
import { UsuarioService } from '../../login/usuario/usuario.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.css']
})
export class ModalComponent implements OnInit {

  display$!: Observable<'open' | 'close'>;

  constructor(
    public userService: UsuarioService,
    private modalService: ModalService,
    public router: Router
  ) { }

  ngOnInit(): void {
    this.display$ = this.modalService.watch();

  }

  aceptar() {
    this.modalService.nuevo_ingreso();
    //this.loginCom.login();
    if (this.modalService.comprobar_ingreso()) {
      this.login();
    } else {
      alert('Ha ocurrido un problema.');
    }
  }

  close() {
    this.modalService.close();
  }

  login() {
    const datos = { usuario: this.modalService.getDatos().usuario, password: this.modalService.getDatos().password, verificacion: true };
    this.userService.ingresar(datos).subscribe(resul => {
      switch (resul["resultado"]) {
        case '3':
          // NUEVA SESION
          alert(resul["mensaje"]);
          // cookies 
          //this.userService.setToken(resul['tokken']);
          this.userService.setUsuario(resul['usuario']);
          this.userService.setTipo(resul['tipo']);
          // local storage
          this.userService.setTokenLS(resul['tokken']);
          // re direccion 
          this.router.navigate(['/' + resul["modulo"]]);
          break;
        case '4':
          // NUEVA INGRESO
          alert(resul["mensaje"]);
          console.log(resul["usuario"]);
          console.log(resul["tipo"]);
          console.log(resul["tokken"]);
          // cookies 
          //this.userService.setToken(resul['tokken']);
          this.userService.setUsuario(resul['usuario']);
          this.userService.setTipo(resul['tipo']);
          // local storage
          this.userService.setTokenLS(resul['tokken']);
          // re direccion 
          this.router.navigate(['/' + resul["modulo"]]);
          break;
        default:
          // OPERACION FALLIDA
          alert('OPERACION FALLIDA ' + resul["mensaje"]);
          break;
      }
    });
  }

}
