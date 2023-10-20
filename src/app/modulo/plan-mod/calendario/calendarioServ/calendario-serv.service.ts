import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class CalendarioServService {

  constructor(private http: HttpClient) { }

  //url = '../modelo/mcc_informe/';
  url_tareas = 'http://localhost/modelo/planificacion/tarea/';
  url = 'http://localhost/modelo/planificacion/asignacion/';

  listar_tareas(cadena: any): Observable<any> {
    return this.http.post(`${this.url_tareas}tarea_listar.php`, JSON.stringify(cadena));
  }

  listar_colaboradores(cadena: any): Observable<any> {
    return this.http.post(`${this.url}asignacion_tareas.php`, JSON.stringify(cadena));
  }

  ingresar_asignacion(cadena: any): Observable<any> {
    return this.http.post(`${this.url}ingresar_asignacion.php`, JSON.stringify(cadena));
  }

  listar_area(cadena: any): Observable<any> {
    return this.http.post(`${this.url}listar_area.php`, JSON.stringify(cadena));
  }

  listar_jornada(cadena: any): Observable<any> {
    return this.http.post(`${this.url}listar_jornada.php`, JSON.stringify(cadena));
  }

  listar_colaboradores_seleccion(cadena: any): Observable<any> {
    return this.http.post(`${this.url}listar_colaboradores_seleccion.php`, JSON.stringify(cadena));
  }

}
