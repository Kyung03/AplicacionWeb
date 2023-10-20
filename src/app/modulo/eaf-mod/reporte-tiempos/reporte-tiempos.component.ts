import { Component, OnInit } from '@angular/core';
import { EafSerService } from '../eafServ/eaf-ser.service';
import * as XLSX from 'xlsx';
import { EafModalService } from '../eaf-modal/eaf-modal.service';
@Component({
  selector: 'app-reporte-tiempos',
  templateUrl: './reporte-tiempos.component.html',
  styleUrls: ['../eaf-mod.component.css']
})
export class ReporteTiemposComponent implements OnInit {

  constructor(
    private serviceEAF: EafSerService,
    private eafModalServ: EafModalService
  ) { }

  fecha_inicio: string = this.serviceEAF.fecha_actual();
  fecha_final: string = this.serviceEAF.fecha_actual();

  fileName = 'Tiempos_Horno_Fusion.xlsx';
  titulos: string[] = [
    'Colada', 'Col.Día', 'Fecha', 'Hora', 'Tiem.Sellado', 'Tiem.Armado', 'T.Recargue1', 'Bov.Abierta1a',
    'T.Recargue2', 'Bov.Abierta2a', 'T.Recargue3',
    'Bov.Abierta3a', 'T.Recargue4', 'Bov.Abierta4a',
    'EspecíficaC1', 'EspecíficaC2', 'EspecíficaC3', 'EspecíficaC4'
  ];
  medida: string[] = [
    "Unidad", "Unidad", "dd/mm/aaaa", "hh/mm/ss",
    "Min", "Min", "Min", "Min", "Min", "Min", "Min",
    "Min", "Min", "Min", "kWh", "kWh", "kWh", "kWh"
  ];
  array_horno_tiempos: Array<any> = [];

  ngOnInit(): void {
    this.informe_tiempo();
  }// ngOnInit

  openModal() {
    this.eafModalServ.open('3');
  } // FIN openModal

  dato_promedio(array_datos: any) {
    var aux = 0, promedio = 0;
    array_datos.forEach((element: number) => {
      aux = aux + element;
    });
    return promedio = aux / array_datos.length
  } // FIN dato_promedio

  exportexcel() {
    /* pass here the table id */
    let element = document.getElementById('excel-table');
    const ws: XLSX.WorkSheet = XLSX.utils.table_to_sheet(element);

    /* generate workbook and add the worksheet */
    const wb: XLSX.WorkBook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    /* save to file */
    XLSX.writeFile(wb, this.fileName);
  } //FIN exportexcel

  informe_tiempo() {
    this.array_horno_tiempos = [];
    this.array_horno_tiempos.splice(0);
    var cont = 0;
    const fechas = { fecha1: this.fecha_inicio, fecha2: this.fecha_final };
    this.serviceEAF.reporte_tiempos(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        Object.values(resul).forEach((element: any) => {
          /*  INSERCION DE PROMEDIO  */
          if (cont > 3) {
            element.splice(element.length, 0, this.dato_promedio(element).toFixed(2));
          } else {
            if (cont == 0) {
              element.splice(element.length, 0, 'Promedio');
            } else {
              element.splice(element.length, 0, '');
            }
          }
          /*  OBJETO CON LOS DATOS  */
          var json_array = [{ titulo: this.titulos[cont], unidad: this.medida[cont], datos: element }];
          /*  INSERCION DE DATOS PARA LA TABLA  */
          this.array_horno_tiempos.push(json_array);
          cont++;
        });
      } else {
        Object.values(this.titulos).forEach(element => {
          var json_array = [{ titulo: element, unidad: this.medida[cont], datos: [''] }];
          this.array_horno_tiempos.push(json_array);
          cont++;
        });
        console.log('No hay datos');
      }
    });
  } //FIN informe_tiempo

}
