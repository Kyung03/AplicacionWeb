import { Component, OnInit } from '@angular/core';
import { EafSerService } from '../eafServ/eaf-ser.service';
import * as XLSX from 'xlsx';
import { EafModalService } from '../eaf-modal/eaf-modal.service';
@Component({
  selector: 'app-reporte-horno',
  templateUrl: './reporte-horno.component.html',
  styleUrls: ['../eaf-mod.component.css']
})
export class ReporteHornoComponent implements OnInit {
  constructor(
    public serviceEAF: EafSerService,
    private eafModalServ: EafModalService
  ) { }
  fecha_inicio: string = this.fecha_actual();
  fecha_final: string = this.fecha_actual();
  titulos: string[] = [
    'Colada', 'Col.Día', 'Fecha', 'Hora', 'Recargue', 'Ox.Lanceado', 'CargaChatarra',
    'M3Lanceado', 'Antracita', 'Grafito', 'TotalCarbón', 'Gasóleo',
    'GLP', 'Oxógeno', 'Espumante', 'Fusión', 'Tiem.Fusión', 'Afino',
    'Tiem.Afino', 'Tiem.Total', 'Ton/Fusión', 'Ton/Afino', 'PowerOn',
    'PowerOff', '%Carbón', 'Temp.Final', 'Tiem.Minutos', 'Endbrick', 'Lingotes', 'Peso acero'
  ];
  medida: string[] = [
    "Unidad", "Unidad", "dd/mm/aaaa", "hh/mm/ss", "Unidad",
    "Nm³", "Ton", "Ton", "Kg", "Kg", "Kg", "L",
    "Nm³", "Nm³", "Kg", "kWh", "Min", "kWh", "Min", "kWh",
    "Ton/Fusion", "Ton/Afino", "Min", "Min", "%",
    "°C", "Min", "Unidad", 'Unidad', 'Ton'
  ];
  array_horno_datos: Array<any> = [];
  fileName = 'Informe_Horno_Fusion.xlsx';

  ngOnInit(): void {
    this.informe_horno();
  }// FIN ngOnInit

  openModal() {
    this.eafModalServ.open('1');
  } // FIN openModal

  informe_horno() {
    this.array_horno_datos = [];
    this.array_horno_datos.splice(0);
    var cont = 0;
    const fechas = { fecha1: this.fecha_inicio, fecha2: this.fecha_final };
    this.serviceEAF.reporte_horno(fechas).subscribe(resul => {
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
          var json_array = [ { titulo: this.titulos[cont], unidad: this.medida[cont], datos: element } ];
          /*  INSERCION DE DATOS PARA LA TABLA  */
          this.array_horno_datos.push(json_array);
          cont++;
        });
      } else {
        Object.values(this.titulos).forEach(element => {
          var json_array = [ { titulo: element, unidad: this.medida[cont], datos: [''] } ];
          this.array_horno_datos.push(json_array);
          cont++;
        });
        console.log('No hay datos');
      }
    });
  } // FIN informe_horno

  dato_promedio(array_datos: any) {
    var aux = 0, promedio = 0;
    array_datos.forEach((element: number) => {
      aux = aux + element;
    });
    return promedio = aux / array_datos.length
  } //FIN dato_promedio

  fecha_actual() {
    var date = new Date();
    var dia = String(date.getDate()).padStart(2, '0');
    var mes = String(date.getMonth() + 1).padStart(2, '0');
    var anio = date.getFullYear();
    var fecha = anio + '-' + mes + '-' + dia;
    return fecha;
  } // FIN fecha_actual

  informe() {
    /* notice the hole where cell "B1" would be */
    var data = [
      ["Merged", "", "C", "D"],
      [1, 2, 3, 4],
      ["a", "b", "c", "d"]
    ];

    /* merge cells A1:B1 */
    var merge = { s: { r: 0, c: 0 }, e: { r: 0, c: 1 } };
    //var merge = XLSX.utils.decode_range("A1:B1"); // this is equivalent

    /* generate worksheet */
    var ws = XLSX.utils.aoa_to_sheet(data);

    /* add merges */
    if (!ws['!merges']) ws['!merges'] = [];
    ws['!merges'].push(merge);

    /* generate workbook */
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "sheet1");

    /* generate file and download */
    const wbout = XLSX.write(wb, { type: "array", bookType: "xlsx" });
    XLSX.writeFile(wb, this.fileName);
    //XLSX.saveAs(new Blob([wbout], { type: "application/octet-stream" }), "issue964.xlsx");
  } // FIN informe()

  exportexcel() {
    /* pass here the table id */
    let element = document.getElementById('excel-table');
    const ws: XLSX.WorkSheet = XLSX.utils.table_to_sheet(element);

    /* generate workbook and add the worksheet */
    const wb: XLSX.WorkBook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    /* save to file */
    XLSX.writeFile(wb, this.fileName);
  } // FIN exportexcel

}
