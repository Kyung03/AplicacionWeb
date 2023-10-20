import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class TareaServService {

  constructor(private http: HttpClient) { }

  url = 'http://localhost/modelo/planificacion/tarea/';

  ingresar_datos(cadena: any): Observable<any> {
    return this.http.post(`${this.url}tarea_guardar.php`, JSON.stringify(cadena));
  }
  listar_tareas(cadena: any): Observable<any> {
    return this.http.post(`${this.url}tarea_listar.php`, JSON.stringify(cadena));
  }

}
