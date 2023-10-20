import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { EafModalService } from './eaf-modal.service';
import { EafSerService } from '../eafServ/eaf-ser.service';
import * as XLSX from 'xlsx';
import { formatDate } from '@angular/common';

@Component({
  selector: 'app-eaf-modal',
  templateUrl: './eaf-modal.component.html',
  styleUrls: ['./eaf-modal.component.css']
})
export class EafModalComponent implements OnInit {

  display$!: Observable<'open' | 'close'>;

  constructor(
    private eafModalSer: EafModalService,
    private serviceEAF: EafSerService
  ) { }

  meses = [
    { mes: 'Enero', valor: 0 },
    { mes: 'Febrero', valor: 1 },
    { mes: 'Marzo', valor: 2 },
    { mes: 'Abril', valor: 3 },
    { mes: 'Mayo', valor: 4 },
    { mes: 'Junio', valor: 5 },
    { mes: 'Julio', valor: 6 },
    { mes: 'Agosto', valor: 7 },
    { mes: 'Septiembre', valor: 8 },
    { mes: 'Octubre', valor: 9 },
    { mes: 'Noviembre', valor: 10 },
    { mes: 'Diciembre', valor: 11 },
  ];
  titulos: string[] = [
    'Colada', 'Col.Dia', 'Fecha', 'Hora', 'Recargue', 'Ox.Lanceado', 'CargaChatarra',
    'M3Lanceado', 'Antracita', 'Grafito', 'TotalCarbon', 'Gasoleo',
    'GLP', 'Oxigeno', 'Espumante', 'Fusion', 'Tiem.Fusion', 'Afino',
    'Tiem.Afino', 'Tiem.Total', 'Ton/Fusion', 'Ton/Afino', 'PowerOn',
    'PowerOff', '%Carbon', 'Temp.Final', 'Tiem.Minutos', 'Endbrick', 'Lingotes', 'Peso acero'
  ];
  medida: string[] = [
    "Unidad", "Unidad", "dd/mm/aaaa", "hh/mm/ss", "Unidad",
    "Nm³", "Ton", "Ton", "Kg", "Kg", "Kg", "L",
    "Nm³", "Nm³", "Kg", "kWh", "Min", "kWh", "Min", "kWh",
    "Ton/Fusion", "Ton/Afino", "Min", "Min", "%",
    "°C", "Min", "Unidad", 'Unidad', 'Ton'
  ];
  array_any: Array<any> = [];
  archivoHorno = 'Informe_Horno_Fusion';
  archivoCompleto = 'Informe_Completo_Horno';
  archivoTiempos = 'Informe_Horno_Tiempos';
  fecha_anio: any;

  ngOnInit(): void {
    this.display$ = this.eafModalSer.watch();
    var date = new Date();
    this.fecha_anio = date.getFullYear();
  } //  FIN ngOnInit

  informe_mes() {
    var y = this.fecha_anio, m = Number(this.fecha_mes().value);
    var firstDay = new Date(y, m, 1);
    var lastDay = new Date(y, m + 1, 0);
    if (this.fecha_anio == null || this.fecha_anio < 0) {
      alert('Valor de fecha invalido');
    } else {
      switch (this.eafModalSer.getCond()) {
        case '1':
          this.datos_mes_horno(formatDate(firstDay, 'yyyy-MM-dd', 'en-US'), formatDate(lastDay, 'yyyy-MM-dd', 'en-US'));
          alert('Informe generado');
          this.close();
          break;
        case '2':
          this.datos_horno_completo(formatDate(firstDay, 'yyyy-MM-dd', 'en-US'), formatDate(lastDay, 'yyyy-MM-dd', 'en-US'));
          alert('Informe generado');
          this.close();
          break;
        case '3':
          this.datos_horno_tiempos(formatDate(firstDay, 'yyyy-MM-dd', 'en-US'), formatDate(lastDay, 'yyyy-MM-dd', 'en-US'));
          alert('Informe generado');
          this.close();
          break;
      }
    }
  } //  FIN informe_mes

  datos_horno_tiempos(fecha_1: any, fecha_2: any) {
    var colada_mes_temp: any[] = [];
    var colada_mes_excel: any[] = [];
    var cont = 0;
    const fechas = { fecha1: fecha_1, fecha2: fecha_2 };
    this.serviceEAF.reporte_tiempos(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        colada_mes_temp = Object.values(resul);
        // INSERSCION DE TITULOS Y UNIDADES DE MEDIDA
        colada_mes_temp.forEach((element: any) => {
          element.splice(0, 0, this.titulos_completo[cont]);
          element.splice(1, 0, this.medida_completo[cont]);
          colada_mes_excel.push(element);
          cont++;
        });
        // GENERACION DEL EXCEL
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(colada_mes_excel);
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        XLSX.writeFile(wb, this.archivoTiempos + '_' + this.fecha_mes().text + ' ' + this.fecha_anio + '.xlsx');
      } else {
        alert('No hay datos del mes: ' + this.fecha_mes().text + ' del año: ' + this.fecha_anio);
        console.log('No hay datos');
      }
    });
  } //  FIN datos_horno_tiempos

  datos_horno_completo(fecha_1: any, fecha_2: any) {
    var colada_mes_temp: any[] = [];
    var colada_mes_excel: any[] = [];
    var cont = 0;
    const fechas = { fecha1: fecha_1, fecha2: fecha_2 };
    this.serviceEAF.reporte_completo(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        colada_mes_temp = Object.values(resul);
        // INSERSCION DE TITULOS Y UNIDADES DE MEDIDA
        colada_mes_temp.forEach((element: any) => {
          element.splice(0, 0, this.titulos_completo[cont]);
          element.splice(1, 0, this.medida_completo[cont]);
          colada_mes_excel.push(element);
          cont++;
        });
        // GENERACION DEL EXCEL
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(colada_mes_excel);
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        XLSX.writeFile(wb, this.archivoCompleto + '_' + this.fecha_mes().text + ' ' + this.fecha_anio + '.xlsx');
      } else {
        alert('No hay datos del mes: ' + this.fecha_mes().text + ' del año: ' + this.fecha_anio);
        console.log('No hay datos');
      }
    });
  } //  FIN datos_horno_completo

  datos_mes_horno(fecha_1: any, fecha_2: any) {
    var colada_mes_temp: any[] = [];
    var colada_mes_excel: any[] = [];
    var cont = 0;
    const fechas = { fecha1: fecha_1, fecha2: fecha_2 };
    this.serviceEAF.reporte_horno(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        colada_mes_temp = Object.values(resul);
        // INSERSCION DE TITULOS Y UNIDADES DE MEDIDA
        colada_mes_temp.forEach((element: any) => {
          element.splice(0, 0, this.titulos[cont]);
          element.splice(1, 0, this.medida[cont]);
          colada_mes_excel.push(element);
          cont++;
        });
        // GENERACION DEL EXCEL
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(colada_mes_excel);
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        XLSX.writeFile(wb, this.archivoHorno + '_' + this.fecha_mes().text + ' ' + this.fecha_anio + '.xlsx');
      } else {
        alert('No hay datos del mes: ' + this.fecha_mes().text + ' del año: ' + this.fecha_anio);
        console.log('No hay datos');
      }
    });
  } //  FIN datos_mes_horno

  fecha_mes() {
    var lista_select = (document.getElementById("select")) as HTMLSelectElement;
    var sel = lista_select.selectedIndex;
    var valor = lista_select.options[sel];
    return (<HTMLOptionElement>valor);
  } //  FIN fecha_mes

  close() {
    this.eafModalSer.close();
  } //  FIN close

  titulos_completo: string[] = [
    'Colada', 'Col.Dia', 'Fecha', 'Hora', 'Recargue', 'Ox.Lanceado', 'CargaChatarra',
    'M3Lanceado', 'Antracita', 'Grafito', 'TotalCarbon', 'Gasoleo',
    'GLP', 'Oxigeno', 'Espumante', 'Fusion', 'Tiem.Fusion', 'Afino',
    'Tiem.Afino', 'Tiem.Total', 'Ton/Fusion', 'Ton/Afino', 'PowerOn',
    'PowerOff', '%Carbon', 'Temp.Final', 'Tiem.Minutos', 'Endbrick',
    'cod_grado', 'cod_fundidor', 'cod_jefe', 'hr_inicio', 'temp_vaciado',
    'cod_jornada', 'pgr_smart', 'pgr_digit', 'peso_cesta1', 'peso_cesta2',
    'peso_cesta3', 'peso_cesta4', 'peso_cesta5', 'col_horno', 'col_delta',
    'col_elect1', 'col_elect2', 'col_elect3', 'caldolomitica',
    'calcalcitica', 'kalister', 'torta', 'temp_centro', 'temp_evt',
    'temp_puerta', 'temp12', 'temp23', 'temp31', 'tmp_sellado',
    'tmp_armado', 'tmp_recargue_1', 'tmp_bov_1r_carga',
    'tmp_recargue_2', 'tmp_bov_2a_carga', 'tmp_recargue_3',
    'tmp_bov_3r_carga', 'tmp_recargue_4', 'tmp_bov_4a_carga',
    'especifica_c1', 'especifica_c2', 'especifica_c3', 'especifica_c4'
  ];
  medida_completo: string[] = [
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

}
