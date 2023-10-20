import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class AdmServService {

  constructor(private http: HttpClient) { }

  //url = '../modelo/adm_informe/';
  url = 'http://localhost/modelo/adm_informe/';

  adm_listar_datos(datos: any): Observable<any> {
    return this.http.post(`${this.url}adm_listar_datos.php`, JSON.stringify(datos));
  }

  adm_guardar_datos(datos: any): Observable<any> {
    return this.http.post(`${this.url}adm_mod_datos.php`, JSON.stringify(datos));
  }
  
  adm_info_op(datos: any): Observable<any> {
    return this.http.post(`${this.url}adm_info_op.php`, JSON.stringify(datos));
  }

  adm_inicio(datos: any): Observable<any> {
    return this.http.post(`${this.url}adm_inicio.php`, JSON.stringify(datos));
  }

  fecha_actual() {
    var date = new Date();
    var dia = String(date.getDate()).padStart(2, '0');
    var mes = String(date.getMonth() + 1).padStart(2, '0');
    var anio = date.getFullYear();
    var fecha = anio + '-' + mes + '-' + dia;
    return fecha;
  }

  toArray(item: any) {
    return Object.keys(item).map(key => item[key]);
  }

}
