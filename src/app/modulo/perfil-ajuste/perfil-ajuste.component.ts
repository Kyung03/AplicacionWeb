import { Component, OnInit } from '@angular/core';
import { UsuarioService } from '../../login/usuario/usuario.service';

@Component({
  selector: 'app-perfil-ajuste',
  templateUrl: './perfil-ajuste.component.html',
  styleUrls: ['./perfil-ajuste.component.css']
})
export class PerfilAjusteComponent implements OnInit {

  constructor(
    public usuarioServ: UsuarioService
  ) { }

  usuario = "";
  tipo = "";
  nombre = "";
  apellido = "";
  verificacion_comp = false;
  verificacion_camb = false;
  clave = "";
  clave_nueva = "";
  clave_rep = "";
  movimiento = "1";
  usuario_bool = false;
  clave_bool = false;

  ngOnInit(): void {
    this.usuario = this.usuarioServ.getUsuario();
    this.tipo = this.usuarioServ.getTipo();
  } // FIN ngOnInit
  
  btn_verifiacar() {
    const informacion = { clave_p: this.clave, usuario_p: this.usuarioServ.getUsuario() };
    if (this.clave == "".trim()) {
      alert('Llenar el campo.');
    } else {
      this.usuarioServ.verificacion_contra(informacion).subscribe(resul => {
        try {
          if (Object.keys(resul).length != 0) {
            if (resul['resultado'] == '1') {
              this.verificacion_comp = true;
              this.verificacion_camb = true;
            } else {
              alert('Contraseña inconrrecta.');
              this.clave = "";
            }
          } else {
            alert('Contraseña inconrrecta.');
            this.clave = "";
          }
        } catch (error) {
          console.log(error);
        }

      });
    } // fin else de espacio vacio
  } // FIN btn_verificar

  btn_mod_us() {
    const datos_us = {
      usuario_p: this.usuario,
      usuario_ant: this.usuarioServ.getUsuario(),
      nombre_p: this.nombre,
      apellido_p: this.apellido,
      clave_nueva_p: this.clave_nueva,
      usuario_bool_p: this.usuario_bool
    };
    if (this.usuario == "".trim()) { alert('Llenar los campos vacios'); }  // fin if llenar campos
    else {
      /* 
      *   MODIFICAR  SIN CONTRASENA
      */
      if (this.verificacion_comp == false) {
        console.log('contraseña sin cambiar');
        if (this.usuario != this.usuarioServ.getUsuario()) {
          //
          this.usuarioServ.mod_datos_us(datos_us).subscribe(resul => {
            console.log(resul);
            if (Object.keys(resul).length != 0) {
              console.log(resul);
              if (resul['resultado'] == '1') {
                this.usuarioServ.setUsuario(resul['usuario']);
                this.clave = "";
                this.usuario = this.usuarioServ.getUsuario();
                alert('Cambio realizado con exito');
              } else {
                alert('Ha ocurrido un problema');
                this.clave = "";
                this.usuario = this.usuarioServ.getUsuario();
              }
            } else { console.log('No hay datos'); }
          });
        } else {// fin verificacion
          alert('No se ha registrado ningun cambio');
        }
      } else {// fin verificacion
        /**
         * MODIFICAR  CON CONTRASENA
         */
        if (this.clave_nueva != "".trim() || this.clave_rep != "".trim()) {
          if (this.clave_nueva == this.clave_rep) {
            if (this.usuario != this.usuarioServ.getUsuario()) datos_us['usuario_bool_p'] = true;
            //
            this.usuarioServ.mod_datos_us_con(datos_us).subscribe(resul => {
              if (Object.keys(resul).length != 0) {
                switch (resul['resultado']) {
                  case '1':
                    this.usuarioServ.setUsuario(resul['usuario']);
                    alert('Cambio realizado con exito Ususario y Clave');
                    this.clave = "";
                    this.clave_nueva = "";
                    this.clave_rep = "";
                    this.verificacion_comp = false;
                    this.verificacion_camb = false;
                    this.usuario = this.usuarioServ.getUsuario();
                    break;
                  case '2':
                    alert('Cambio realizado con exito Clave');
                    this.clave = "";
                    this.clave_nueva = "";
                    this.clave_rep = "";
                    this.verificacion_comp = false;
                    this.verificacion_camb = false;
                    this.usuario = this.usuarioServ.getUsuario();
                    break;
                  case '3':
                    alert('Ha ocurrido un problema');
                    this.clave = "";
                    this.clave_nueva = "";
                    this.clave_rep = "";
                    this.verificacion_comp = false;
                    this.verificacion_camb = false;
                    this.usuario = this.usuarioServ.getUsuario();
                    break;
                  case '0':
                    alert('Error en el proceso');
                    this.clave = "";
                    this.clave_nueva = "";
                    this.clave_rep = "";
                    this.verificacion_comp = false;
                    this.verificacion_camb = false;
                    this.usuario = this.usuarioServ.getUsuario();
                    break;
                }
              } else { console.log('No hay datos'); }
            });
          } else { // fin verificacion inputs clave
            alert('La contraseña no coincide');
          }
        } else { // fin if inputs vacios
          alert('Llenar los campos vacios.');
        }
      }
    } // fin else llenar campos
  } // FIN btn_mod_us

}
