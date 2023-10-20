import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class EafSerService {

  constructor(private http: HttpClient) { }

  //url = '../modelo/eaf_informe/';
  url = 'http://localhost/modelo/eaf_informe/';

  reporte_horno(fechas: any): Observable<any> {
    return this.http.post(`${this.url}horno_fusion_colada.php`, JSON.stringify(fechas));
  }

  reporte_tiempos(fechas: any): Observable<any> {
    return this.http.post(`${this.url}tiempos.php`, JSON.stringify(fechas));
  }

  reporte_completo(fechas: any): Observable<any> {
    return this.http.post(`${this.url}completo.php`, JSON.stringify(fechas));
  }

  fecha_actual() {
    var date = new Date();
    var dia = String(date.getDate()).padStart(2, '0');
    var mes = String(date.getMonth() + 1).padStart(2, '0');
    var anio = date.getFullYear();
    var fecha = anio + '-' + mes + '-' + dia;
    return fecha;
  }

}
