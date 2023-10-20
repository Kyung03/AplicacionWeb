import { Component, OnInit } from '@angular/core';
import { EafSerService } from '../eafServ/eaf-ser.service';
import * as XLSX from 'xlsx';
import { EafModalService } from '../eaf-modal/eaf-modal.service';
@Component({
  selector: 'app-reporte-completo',
  templateUrl: './reporte-completo.component.html',
  styleUrls: ['../eaf-mod.component.css']
})
export class ReporteCompletoComponent implements OnInit {
  constructor(
    private serviceEAF: EafSerService,
    private eafModalServ: EafModalService
    ) { }
  fecha_inicio: string = this.serviceEAF.fecha_actual();
  fecha_final: string = this.serviceEAF.fecha_actual();
  titulos: string[] = [
    'Colada', 'Col.Día', 'Fecha', 'Hora', 'Recargue', 'Ox.Lanceado', 'CargaChatarra',
    'M3Lanceado', 'Antracita', 'Grafito', 'TotalCarbón', 'Gasóleo',
    'GLP', 'Oxígeno', 'Espumante', 'EnergíaFusión', 'Tiem.Fusión', 'EnergíaAfino',
    'Tiem.Afino', 'EnergíaTotal', 'Ton/Fusión', 'Ton/Afino', 'PowerOn',
    'PowerOff', '%Carbón', 'Temp.Final', 'Tiem.Total', 'Endbrick',
    'Grado', 'Fundidor', 'JefeTurno', 'HoraInicio', 'Tiem.Vaciado',
    'Jornada', 'PrograSmart', 'PrograDigit', 'PesoCesta1', 'PesoCesta2',
    'PesoCesta3', 'PesoCesta4', 'PesoCesta5', 'Col.Horno', 'Col.Delta',
    'Col.Elect1', 'Col.Elect2', 'Col.Elect3', 'CalDolomítica',
    'CalCalcítica', 'Kalister', 'Torta', 'Temp.Centro', 'Temp.EBT',
    'Temp.Puerta', 'Temp.12', 'Temp.23', 'Temp.31', 'Tiem.Sellado',
    'Tiem.Armado', 'T.Recargue1', 'Bov.Abierta1a',
    'T.Recargue2', 'Bov.Abierta2a', 'T.Recargue3',
    'Bov.Abierta3a', 'T.Recargue4', 'Bov.Abierta4a',
    'EspecíficaC1', 'EspecíficaC2', 'EspecíficaC3', 'EspecíficaC4'
  ];
  medida: string[] = [
    "Unidad", "Unidad", "dd/mm/aaaa", "hh/mm/ss", "Unidad",
    "Nm³", "Ton", "Ton", "Kg", "Kg", "Kg", "L",
    "Nm³", "Nm³", "Kg", "kWh", "Min", "kWh", "Min", "kWh",
    "Ton/Fusion", "Ton/Afino", "Min", "Min", "%",
    "°C", "Min", "Unidad", "", "", "", "Min", "Min", "", "Min", "Min",
    "Ton", "Ton", "Ton", "Ton", "Ton", "Colada", "Colada", "Colada",
    "Colada", "Colada", "Kg", "Kg", "Kg", "Ton", "°C", "°C", "°C",
    "°C", "°C", "°C", "Min", "Min", "Min", "Min", "Min", "Min", "Min",
    "Min", "Min", "Min", "kWh", "kWh", "kWh", "kWh"
  ];
  fileName = 'Datos_Horno_Fusion.xlsx';
  array_any: Array<any> = [];

  ngOnInit(): void {
    this.informe_completo();
  }

  openModal() {
    this.eafModalServ.open('2');
  } // FIN openModal()
  
  informe_completo() {
    this.array_any = [];
    this.array_any.splice(0);
    var cont = 0;
    const fechas = { fecha1: this.fecha_inicio, fecha2: this.fecha_final };
    this.serviceEAF.reporte_completo(fechas).subscribe(resul => {
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
          var json_array = [ { titulo: this.titulos[cont], unidad: this.medida[cont], datos: element } ];
          this.array_any.push(json_array);
          cont++;
        });
      } else {
        Object.values(this.titulos).forEach(element => {
          var json_array = [ { titulo: element, unidad: this.medida[cont], datos: [''] } ];
          this.array_any.push(json_array);
          cont++;
        });
      }
    });
  }// FIN informe_completo()

  dato_promedio(array_datos: any) {
    var aux = 0, promedio = 0;
    array_datos.forEach((element: number) => {
      aux = aux + element;
    });
    return promedio = aux / array_datos.length
  } //FIN dato_promedio()

  exportexcel() {
    /* pass here the table id */
    let element = document.getElementById('excel-table');
    const ws: XLSX.WorkSheet = XLSX.utils.table_to_sheet(element);

    /* generate workbook and add the worksheet */
    const wb: XLSX.WorkBook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    /* save to file */
    XLSX.writeFile(wb, this.fileName);
  } // FIN exportexcel()

  toArray(item: any) {
    return Object.keys(item).map(key => item[key]);
  } // FIN toArray()

}
