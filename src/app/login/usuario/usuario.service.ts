import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";
import { CookieService } from 'ngx-cookie-service';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {

  //url = '../modelo/';
  //url = 'http://localhost/modelo/'; laptop
  url = 'http://localhost/modelo/';
  
  constructor(private http: HttpClient, private cookies: CookieService) { }

  ingresar(user: any): Observable<any> {
    return this.http.post(`${this.url}ingreso.php`, JSON.stringify(user));
  }

  setToken(token: string) {
    this.cookies.set("token", token);
  }

  getToken() {
    return this.cookies.get("token");
  }

  setUsuario(usuario: string) {
    this.cookies.set("usuario", usuario);
  }

  getUsuario() {
    return this.cookies.get("usuario");
  }

  setTipo(tipo: string) {
    this.cookies.set("tipo", tipo);
  }

  getTipo() {
    return this.cookies.get("tipo");
  }

  cerrar(us_des: any): Observable<any> {
    return this.http.post(`${this.url}cerrar_sesion.php`, JSON.stringify(us_des));
  }

  limpiar_cookies() {
    this.cookies.deleteAll();
    localStorage.clear();
  }

  setTokenLS(token: string) {
    localStorage.setItem("tokenLS", token);
  }

  getTokenLS() {
    return localStorage.getItem("tokenLS");
  }

  checkTokenLS(){
    return localStorage.key(0);
  }

  comprobar_sesion(user: any): Observable<any> {
    return this.http.post(`${this.url}comprobacion.php`, JSON.stringify(user));
  }

  cookies_existencias(token:any){
    return this.cookies.check(token);
  }


  verificacion_contra(contraseña_info: any): Observable<any> {
    return this.http.post(`${this.url}datos_us_verificar.php`, JSON.stringify(contraseña_info));
  }

  mod_datos_us(datos_us: any): Observable<any> {
    return this.http.post(`${this.url}datos_us_modificar.php`, JSON.stringify(datos_us));
  }

  mod_datos_us_con(datos_us: any): Observable<any> {
    return this.http.post(`${this.url}datos_us_modificar_con.php`, JSON.stringify(datos_us));
  }

}
