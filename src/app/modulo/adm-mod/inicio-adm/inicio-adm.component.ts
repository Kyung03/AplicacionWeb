import { Component, OnInit } from '@angular/core';
import { AdmServService } from '../admServ/adm-serv.service';
import { Chart } from 'chart.js/auto';

@Component({
  selector: 'app-inicio-adm',
  templateUrl: './inicio-adm.component.html',
  styleUrls: ['./inicio-adm.component.css']
})
export class InicioAdmComponent implements OnInit {

  constructor(public admServ: AdmServService) { }

  col_hoy_t: any;
  col_hoy_u: any;
  col_hoy_p: any;
  col_ayer_t: any;
  col_ayer_u: any;
  col_ayer_p: any;

  coladas: any = [];
  semanas_titlo: any = [];
  semanas_datos: any = [];

  public graficaInicio: any;
  fecha_final:string = this.admServ.fecha_actual();

  data =
    {
      label: "Coladas",
      data: [],
      backgroundColor: 'blue'
    };

  data2 =
    {
      label: "Toneladas",
      data: [],
      backgroundColor: 'red'
    };

  ngOnInit(): void {
    this.fechas_set();
    this.graficaInicio = new Chart("MiGrafica", {
      type: 'bar',
      data: {
        labels: this.semanas_titlo,
        datasets: [this.data, this.data2]
      },
      options: {
        aspectRatio: 2.5
      }
    });
    this.informe_datos();
  } // FIN ngOnInit

  inicio() {
    this.graficaInicio.data.labels = [];
    this.fechas_set();
    this.graficaInicio.data.labels = this.semanas_titlo;
    this.informe_datos();
  } // FIN inicio
  
  fechas_set() {
    this.semanas_datos = [];
    this.semanas_datos.splice(0);
    this.semanas_titlo = [];
    this.semanas_titlo.splice(0);
    
    var curr = new Date(this.fecha_final);
    for (var i = 0; i < 7; i++) {
      var aux = new Date(curr.setDate(curr.getDate() - curr.getDay() + i)).toLocaleString(undefined, { year: 'numeric', month: '2-digit', day: '2-digit', weekday: "long" });
      var fecha_aux = new Date(curr.setDate(curr.getDate() - curr.getDay() + i));
      var dia = String(fecha_aux.getDate()).padStart(2, '0');
      var mes = String(fecha_aux.getMonth() + 1).padStart(2, '0');
      var anio = fecha_aux.getFullYear();
      var fecha = anio + '-' + mes + '-' + dia;
      this.semanas_datos.push(fecha);
      this.semanas_titlo.push(aux);
    }
  } // FIN fechas_set

  informe_datos() {
    const datos = {
      fecha_p: this.fecha_final
    };
    this.admServ.adm_inicio(this.semanas_datos).subscribe(resul => {
      var tonelaje_array = [];
      var colada_array = [];
      if (Object.keys(resul).length != 0) {
        for (var i = 0; i < resul['datos'].length; i++) {
          this.coladas.push(resul['datos'][i][0].length);
          colada_array.push(resul['datos'][i][0].length);
          var tonelaje = 0;
          resul['datos'][i][4].forEach((element: any) => {
            tonelaje = tonelaje + parseInt(element);
          });
          tonelaje_array.push(tonelaje);
        }
        // INGRESO DE DATOS A LA GRAFICA
        this.graficaInicio.data.datasets[0].data = [];
        this.graficaInicio.data.datasets[0].data = colada_array;
        this.graficaInicio.data.datasets[1].data = tonelaje_array;
        this.graficaInicio.update();
        // INFORMACION COLADAS HOY
        this.col_hoy_t = resul['grafica'][0][0];
        this.col_hoy_u = resul['grafica'][0][1];
        this.col_hoy_p = (resul['grafica'][0][2] / resul['grafica'][0][0]).toFixed(2);
        // INFORMACION COLADAS AYER
        this.col_ayer_t = resul['grafica'][1][0];
        this.col_ayer_u = resul['grafica'][1][1];
        this.col_ayer_p = (resul['grafica'][1][2] / resul['grafica'][1][0]).toFixed(2);
      } else {
        console.log('No hay datos');
      }
    });
  } // FIN informe_datos

}
