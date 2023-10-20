import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class MccServService {

  constructor(private http: HttpClient) { }

  //url = '../modelo/mcc_informe/';
  url = 'http://localhost/modelo/mcc_informe/';

  listar_datos(fechas: any): Observable<any> {
    return this.http.post(`${this.url}mcc_listar_datos.php`, JSON.stringify(fechas));
  }

  ingresar_datos(fechas: any): Observable<any> {
    return this.http.post(`${this.url}mcc_ingresar_datos.php`, JSON.stringify(fechas));
  }

  mod_listar_datos(fechas: any): Observable<any> {
    return this.http.post(`${this.url}mcc_mod_listar.php`, JSON.stringify(fechas));
  }

  mod_datos(fechas: any): Observable<any> {
    return this.http.post(`${this.url}mcc_mod_datos.php`, JSON.stringify(fechas));
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
