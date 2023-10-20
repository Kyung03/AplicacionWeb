import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class ColaboradorServService {

  constructor(private http: HttpClient) { }

  url = 'http://localhost/modelo/planificacion/';

  listar_datos(cadena: any): Observable<any> {
    return this.http.post(`${this.url}colaborador_area_listado.php`, JSON.stringify(cadena));
  }
  ingresar_datos(cadena: any): Observable<any> {
    return this.http.post(`${this.url}colaborador_guardar.php`, JSON.stringify(cadena));
  }
  listar_colaboradores(cadena: any): Observable<any> {
    return this.http.post(`${this.url}colaborador_listado.php`, JSON.stringify(cadena));
  }

}
