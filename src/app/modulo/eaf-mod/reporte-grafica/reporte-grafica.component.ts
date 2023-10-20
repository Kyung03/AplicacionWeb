import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { Chart } from 'chart.js/auto';
import { EafSerService } from '../eafServ/eaf-ser.service';


@Component({
  selector: 'app-reporte-grafica',
  templateUrl: './reporte-grafica.component.html',
  styleUrls: ['./reporte-grafica.component.css']
})
export class ReporteGraficaComponent implements OnInit {

  constructor(public serviceEAF: EafSerService) { }

  public grafica: any;

  fecha_inicio: string = this.serviceEAF.fecha_actual();
  fecha_final: string = this.serviceEAF.fecha_actual();
  datos: any;

  ngOnInit(): void {
    this.grafica = new Chart("reporteGrafica", {
      type: 'line',
      data: {
        labels: [],
        datasets: [
          this.dato_Recargues,
          this.dato_OxigenoLanceado,
          this.dato_TonChatarra,
          this.dato_Antracita,
          this.dato_Grafito,
          this.dato_TotalCarbon,
          this.dato_Gasoleo,
          this.dato_GLP,
          this.dato_Oxigeno,
          this.dato_espumante,
          this.dato_KwhFusion,
          this.dato_TiempoFusion,
          this.dato_KwhAfino,
          this.dato_TiempoAfino,
          this.dato_TiempoTotal,
          this.dato_PowerON,
          this.dato_PowerOFF,
          this.dato_Carbon,
          this.dato_TemperaturaVaciado,
          this.dato_TiempoMinutos,
          this.dato_endbrick,
          this.dato_TiempoVaciado,
          this.dato_PrograSmart,
          this.dato_PrograDigit,
          this.dato_PesoCesta1,
          this.dato_PesoCesta2,
          this.dato_PesoCesta3,
          this.dato_PesoCesta4,
          this.dato_PesoCesta5,
          this.dato_ColadasHorno,
          this.dato_ColadasDelta,
          this.dato_ColadasElec1,
          this.dato_ColadasElect2,
          this.dato_ColadasElect3,
          this.dato_CalDolomitica,
          this.dato_CalCalcitica,
          this.dato_Kalister,
          this.dato_Torta,
          this.dato_TempCentro,
          this.dato_TempEVT,
          this.dato_TempPuerta,
          this.dato_Temp12,
          this.dato_Temp23,
          this.dato_Temp31,
          this.dato_tmp_sellado,
          this.dato_tmp_armado,
          this.dato_tmp_recargue_1,
          this.dato_tmp_bov_1r_carga,
          this.dato_tmp_recargue_2,
          this.dato_tmp_bov_2a_carga,
          this.dato_tmp_recargue_3,
          this.dato_tmp_bov_3r_carga,
          this.dato_tmp_recargue_4,
          this.dato_tmp_bov_4a_carga,
          this.dato_especifica_c1,
          this.dato_especifica_c2,
          this.dato_especifica_c3,
          this.dato_especifica_c4
        ]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        }
      },
    });

    this.crear_check();
    const dataset0 = document.getElementById('dataset0');
    const dataset1 = document.getElementById('dataset1');
    const dataset2 = document.getElementById('dataset2');
    const dataset3 = document.getElementById('dataset3');
    const dataset4 = document.getElementById('dataset4');
    const dataset5 = document.getElementById('dataset5');
    const dataset6 = document.getElementById('dataset6');
    const dataset7 = document.getElementById('dataset7');
    const dataset8 = document.getElementById('dataset8');
    const dataset9 = document.getElementById('dataset9');
    const dataset10 = document.getElementById('dataset10');
    const dataset11 = document.getElementById('dataset11');
    const dataset12 = document.getElementById('dataset12');
    const dataset13 = document.getElementById('dataset13');
    const dataset14 = document.getElementById('dataset14');
    const dataset15 = document.getElementById('dataset15');
    const dataset16 = document.getElementById('dataset16');
    const dataset17 = document.getElementById('dataset17');
    const dataset18 = document.getElementById('dataset18');
    const dataset19 = document.getElementById('dataset19');
    const dataset20 = document.getElementById('dataset20');
    const dataset21 = document.getElementById('dataset21');
    const dataset22 = document.getElementById('dataset22');
    const dataset23 = document.getElementById('dataset23');
    const dataset24 = document.getElementById('dataset24');
    const dataset25 = document.getElementById('dataset25');
    const dataset26 = document.getElementById('dataset26');
    const dataset27 = document.getElementById('dataset27');
    const dataset28 = document.getElementById('dataset28');
    const dataset29 = document.getElementById('dataset29');
    const dataset30 = document.getElementById('dataset30');
    const dataset31 = document.getElementById('dataset31');
    const dataset32 = document.getElementById('dataset32');
    const dataset33 = document.getElementById('dataset33');
    const dataset34 = document.getElementById('dataset34');
    const dataset35 = document.getElementById('dataset35');
    const dataset36 = document.getElementById('dataset36');
    const dataset37 = document.getElementById('dataset37');
    const dataset38 = document.getElementById('dataset38');
    const dataset39 = document.getElementById('dataset39');
    const dataset40 = document.getElementById('dataset40');
    const dataset41 = document.getElementById('dataset41');
    const dataset42 = document.getElementById('dataset42');
    const dataset43 = document.getElementById('dataset43');

    const dataset44 = document.getElementById('dataset44');
    const dataset45 = document.getElementById('dataset45');
    const dataset46 = document.getElementById('dataset46');
    const dataset47 = document.getElementById('dataset47');
    const dataset48 = document.getElementById('dataset48');
    const dataset49 = document.getElementById('dataset49');
    const dataset50 = document.getElementById('dataset50');
    const dataset51 = document.getElementById('dataset51');
    const dataset52 = document.getElementById('dataset52');
    const dataset53 = document.getElementById('dataset53');
    const dataset54 = document.getElementById('dataset54');
    const dataset55 = document.getElementById('dataset55');
    const dataset56 = document.getElementById('dataset56');
    const dataset57 = document.getElementById('dataset57');
    dataset0?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });
    dataset1?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset2?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset3?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset4?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset5?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset6?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset7?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset8?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset9?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset10?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset11?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset12?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset13?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset14?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset15?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset16?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset17?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset18?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset19?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset20?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset21?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset22?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset23?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset24?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset25?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset26?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset27?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset28?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset29?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset30?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset31?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset32?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset33?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset34?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset35?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset36?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset37?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset38?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset39?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset40?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset41?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset42?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset43?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset44?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset45?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset46?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset47?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset48?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset49?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset50?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset51?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset52?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset53?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset54?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset55?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset56?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });

    dataset57?.addEventListener('change', (e) => {
      this.checkboxEfect(this.grafica, e);
    });
    this.informe_grafica();
  }

  informe_grafica() {
    this.datosColada();
  }

  graficaColada() {
    var labels_grafica = this.grafica.data.labels.length;
    for (var b = 0; b <= labels_grafica; b++) {
      this.grafica.data.labels.pop();
    }
    var data_grafica = this.grafica.data.datasets[0].data.length;
    var data_consulta = this.coladas.length;

    for (var a = 0; a < data_grafica + data_consulta; a++) {
      this.grafica.data.datasets[0].data.pop();
      this.grafica.data.datasets[1].data.pop();
      this.grafica.data.datasets[2].data.pop();
      this.grafica.data.datasets[3].data.pop();
      this.grafica.data.datasets[4].data.pop();
      this.grafica.data.datasets[5].data.pop();
      this.grafica.data.datasets[6].data.pop();
      this.grafica.data.datasets[7].data.pop();
      this.grafica.data.datasets[8].data.pop();
      this.grafica.data.datasets[9].data.pop();
      this.grafica.data.datasets[10].data.pop();
      this.grafica.data.datasets[11].data.pop();
      this.grafica.data.datasets[12].data.pop();
      this.grafica.data.datasets[13].data.pop();
      this.grafica.data.datasets[14].data.pop();
      this.grafica.data.datasets[15].data.pop();
      this.grafica.data.datasets[16].data.pop();
      this.grafica.data.datasets[17].data.pop();
      this.grafica.data.datasets[18].data.pop();
      this.grafica.data.datasets[19].data.pop();
      this.grafica.data.datasets[20].data.pop();
      this.grafica.data.datasets[21].data.pop();
      this.grafica.data.datasets[22].data.pop();
      this.grafica.data.datasets[23].data.pop();
      this.grafica.data.datasets[24].data.pop();
      this.grafica.data.datasets[25].data.pop();
      this.grafica.data.datasets[26].data.pop();
      this.grafica.data.datasets[27].data.pop();
      this.grafica.data.datasets[28].data.pop();
      this.grafica.data.datasets[29].data.pop();
      this.grafica.data.datasets[30].data.pop();
      this.grafica.data.datasets[31].data.pop();
      this.grafica.data.datasets[32].data.pop();
      this.grafica.data.datasets[33].data.pop();
      this.grafica.data.datasets[34].data.pop();
      this.grafica.data.datasets[35].data.pop();
      this.grafica.data.datasets[36].data.pop();
      this.grafica.data.datasets[37].data.pop();
      this.grafica.data.datasets[38].data.pop();
      this.grafica.data.datasets[39].data.pop();
      this.grafica.data.datasets[40].data.pop();
      this.grafica.data.datasets[41].data.pop();
      this.grafica.data.datasets[42].data.pop();
      this.grafica.data.datasets[43].data.pop();
      this.grafica.data.datasets[44].data.pop();
      this.grafica.data.datasets[45].data.pop();
      this.grafica.data.datasets[46].data.pop();
      this.grafica.data.datasets[47].data.pop();
      this.grafica.data.datasets[48].data.pop();
      this.grafica.data.datasets[49].data.pop();
      this.grafica.data.datasets[50].data.pop();
      this.grafica.data.datasets[51].data.pop();
      this.grafica.data.datasets[52].data.pop();
      this.grafica.data.datasets[53].data.pop();
      this.grafica.data.datasets[54].data.pop();
      this.grafica.data.datasets[55].data.pop();
      this.grafica.data.datasets[56].data.pop();
      this.grafica.data.datasets[57].data.pop();
    }

    for (var a = 0; a < this.coladas.length; a++) {
      this.grafica.data.labels.push(this.coladas[a]);
      //  ACTUALIZACION DE LOS DATO DE LA GRAFICA
      this.grafica.data.datasets[0].data.push(this.recargue[a]);
      this.grafica.data.datasets[1].data.push(this.oxlan[a]);
      this.grafica.data.datasets[2].data.push(this.tonChatarra[a]);
      // m3
      this.grafica.data.datasets[3].data.push(this.antracita[a]);
      this.grafica.data.datasets[4].data.push(this.grafito[a]);
      this.grafica.data.datasets[5].data.push(this.tcarbon[a]);
      this.grafica.data.datasets[6].data.push(this.gasoleo[a]);
      this.grafica.data.datasets[7].data.push(this.glp[a]);
      this.grafica.data.datasets[8].data.push(this.oxigeno[a]);
      this.grafica.data.datasets[9].data.push(this.espumante[a]);
      this.grafica.data.datasets[10].data.push(this.fusion[a]);
      this.grafica.data.datasets[11].data.push(this.tfusion[a]);
      this.grafica.data.datasets[12].data.push(this.afino[a]);
      this.grafica.data.datasets[13].data.push(this.tafino[a]);
      this.grafica.data.datasets[14].data.push(this.ttotal[a]);
      // ton fusion
      // ton afino
      this.grafica.data.datasets[15].data.push(this.on[a]);
      this.grafica.data.datasets[16].data.push(this.off[a]);
      this.grafica.data.datasets[17].data.push(this.carbon[a]);
      this.grafica.data.datasets[18].data.push(this.tempVaciado[a]);
      this.grafica.data.datasets[19].data.push(this.tminutos[a]);
      this.grafica.data.datasets[20].data.push(this.endbrick[a]);
      this.grafica.data.datasets[21].data.push(this.temp_vaciado[a]);
      this.grafica.data.datasets[22].data.push(this.pgr_smart[a]);
      this.grafica.data.datasets[23].data.push(this.pgr_digit[a]);
      this.grafica.data.datasets[24].data.push(this.peso_cesta1[a]);
      this.grafica.data.datasets[25].data.push(this.peso_cesta2[a]);
      this.grafica.data.datasets[26].data.push(this.peso_cesta3[a]);
      this.grafica.data.datasets[27].data.push(this.peso_cesta4[a]);
      this.grafica.data.datasets[28].data.push(this.peso_cesta5[a]);
      this.grafica.data.datasets[29].data.push(this.col_horno[a]);
      this.grafica.data.datasets[30].data.push(this.col_delta[a]);
      this.grafica.data.datasets[31].data.push(this.col_elect1[a]);
      this.grafica.data.datasets[32].data.push(this.col_elect2[a]);
      this.grafica.data.datasets[33].data.push(this.col_elect3[a]);
      this.grafica.data.datasets[34].data.push(this.caldolomitica[a]);
      this.grafica.data.datasets[35].data.push(this.calcalcitica[a]);
      this.grafica.data.datasets[36].data.push(this.kalister[a]);
      this.grafica.data.datasets[37].data.push(this.torta[a]);
      this.grafica.data.datasets[38].data.push(this.temp_centro[a]);
      this.grafica.data.datasets[39].data.push(this.temp_evt[a]);
      this.grafica.data.datasets[40].data.push(this.temp_puerta[a]);
      this.grafica.data.datasets[41].data.push(this.temp12[a]);
      this.grafica.data.datasets[42].data.push(this.temp23[a]);
      this.grafica.data.datasets[43].data.push(this.temp31[a]);
      this.grafica.data.datasets[44].data.push(this.tmp_sellado[a]);
      this.grafica.data.datasets[45].data.push(this.tmp_armado[a]);
      this.grafica.data.datasets[46].data.push(this.tmp_recargue_1[a]);
      this.grafica.data.datasets[47].data.push(this.tmp_bov_1r_carga[a]);
      this.grafica.data.datasets[48].data.push(this.tmp_recargue_2[a]);
      this.grafica.data.datasets[49].data.push(this.tmp_bov_2a_carga[a]);
      this.grafica.data.datasets[50].data.push(this.tmp_recargue_3[a]);
      this.grafica.data.datasets[51].data.push(this.tmp_bov_3r_carga[a]);
      this.grafica.data.datasets[52].data.push(this.tmp_recargue_4[a]);
      this.grafica.data.datasets[53].data.push(this.tmp_bov_4a_carga[a]);
      this.grafica.data.datasets[54].data.push(this.especifica_c1[a]);
      this.grafica.data.datasets[55].data.push(this.especifica_c2[a]);
      this.grafica.data.datasets[56].data.push(this.especifica_c3[a]);
      this.grafica.data.datasets[57].data.push(this.especifica_c4[a]);
    }
    this.grafica.update();
  } // fin graficaColada

  crear_check() {
    const legend = document.getElementById("legend");
    var cont = 0;
    this.grafica.data.datasets.forEach((dataset: any, index: any) => {
      // creacion de la check box
      let checkbox = document.createElement('input');
      let div_col = document.createElement('div');
      div_col.className = 'col-md-3';
      checkbox.type = 'checkbox';
      checkbox.name = dataset.label;
      checkbox.value = index;
      checkbox.id = `dataset${index}`;
      checkbox.checked = false;

      // label
      let label = document.createElement('label');
      label.htmlFor = `dataset${index}`;
      let labeltext = document.createTextNode(dataset.label);

      label.appendChild(labeltext);
      div_col.appendChild(checkbox);
      div_col.appendChild(label);
      legend?.appendChild(div_col);
    });
  } // FIN crear_check

  checkboxEfect(mychart: any, element: any) {
    const index = element.target.value;
    if (mychart.isDatasetVisible(index)) {
      mychart.data.datasets[index].hidden = true;
      this.grafica.update();
    } else {
      mychart.data.datasets[index].hidden = false; this.grafica
      this.grafica.update();
    }
  } // FIN checkboxEfect

  datosColada() {
    const fechas = { fecha1: this.fecha_inicio, fecha2: this.fecha_final };
    this.serviceEAF.reporte_completo(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        this.datos = resul;
        this.coladas = resul['coladas'];
        this.fecha = resul['fecha'];
        this.hora = resul['hora'];
        this.recargue = resul['recargue'];
        this.oxlan = resul['oxlan'];
        this.tonChatarra = resul['tonChatarra'];
        this.m3 = resul['m3'];
        this.antracita = resul['antracita'];
        this.grafito = resul['grafito'];
        this.tcarbon = resul['tcarbon'];
        this.gasoleo = resul['gasoleo'];
        this.glp = resul['glp'];
        this.oxigeno = resul['oxigeno'];
        this.espumante = resul['espumante'];
        this.fusion = resul['fusion'];
        this.tfusion = resul['tfusion'];
        this.afino = resul['afino'];
        this.tafino = resul['tafino'];
        this.ttotal = resul['ttotal'];
        this.tonfusion = resul['tonfusion'];
        this.tonafino = resul['tonafino'];
        this.on = resul['on'];
        this.off = resul['off'];
        this.carbon = resul['carbon'];
        this.tempVaciado = resul['tempVaciado'];
        this.tminutos = resul['tminutos'];
        this.endbrick = resul['endbrick'];

        this.cod_grado = resul['cod_grado'];
        this.cod_fundidor = resul['cod_fundidor'];
        this.cod_jefe = resul['cod_jefe'];
        this.hr_inicio = resul['hr_inicio'];
        this.temp_vaciado = resul['temp_vaciado'];
        this.cod_jornada = resul['cod_jornada'];
        this.pgr_smart = resul['pgr_smart'];
        this.pgr_digit = resul['pgr_digit'];
        this.peso_cesta1 = resul['peso_cesta1'];
        this.peso_cesta2 = resul['peso_cesta2'];
        this.peso_cesta3 = resul['peso_cesta3'];
        this.peso_cesta4 = resul['peso_cesta4'];
        this.peso_cesta5 = resul['peso_cesta5'];
        this.col_horno = resul['col_horno'];
        this.col_delta = resul['col_delta'];
        this.col_elect1 = resul['col_elect1'];
        this.col_elect2 = resul['col_elect2'];
        this.col_elect3 = resul['col_elect3'];
        this.caldolomitica = resul['caldolomitica'];
        this.calcalcitica = resul['calcalcitica'];
        this.kalister = resul['kalister'];
        this.torta = resul['torta'];
        this.temp_centro = resul['temp_centro'];
        this.temp_evt = resul['temp_evt'];
        this.temp_puerta = resul['temp_puerta'];
        this.temp12 = resul['temp12'];
        this.temp23 = resul['temp23'];
        this.temp31 = resul['temp31'];

        this.tmp_sellado = resul['tmp_sellado'];
        this.tmp_armado = resul['tmp_armado'];
        this.tmp_recargue_1 = resul['tmp_recargue_1'];
        this.tmp_bov_1r_carga = resul['tmp_bov_1r_carga'];
        this.tmp_recargue_2 = resul['tmp_recargue_2'];
        this.tmp_bov_2a_carga = resul['tmp_bov_2a_carga'];
        this.tmp_recargue_3 = resul['tmp_recargue_3'];
        this.tmp_bov_3r_carga = resul['tmp_bov_3r_carga'];
        this.tmp_recargue_4 = resul['tmp_recargue_4'];
        this.tmp_bov_4a_carga = resul['tmp_bov_4a_carga'];
        this.especifica_c1 = resul['especifica_c1'];
        this.especifica_c2 = resul['especifica_c2'];
        this.especifica_c3 = resul['especifica_c3'];
        this.especifica_c4 = resul['especifica_c4'];
        this.graficaColada();
      } else {
        console.log('No hay datos');
      }
    });
  } // FIN datosColada

  crearGrafica() {
    this.grafica = new Chart("reporteGrafica", {
      type: 'bar',
      data: {
        labels: ['2022-05-10', '2022-05-10', '2022-05-10', '2022-05-10', '2022-05-10', '2022-05-10', '2022-05-10', '2022-05-10'],
        datasets: [
          {
            label: "sales",
            data: ['467', '572', '576', '79', '92', '574', '573', '576'],
            backgroundColor: 'blue'
          },
          {
            label: "profit",
            data: ['572', '542', '536', '327', '17', '0.00', '538', '541'],
            backgroundColor: 'limegreen'
          }
        ]
      },
      options: {
        aspectRatio: 2.5
      }
    });
  } // fin crearGrafica

  dato_Recargues = {
    label: "Recargues",
    data: [],
    hidden: true,
    backgroundcolor: 'blue',
  };//0
  dato_OxigenoLanceado = {
    label: "Oxígeno Lanceado",
    data: [],
    hidden: true,
    backgroundcolor: 'limegreen',
  };//1
  dato_TonChatarra = {
    label: "Ton/Chatarra",
    data: [],
    hidden: true,
    backgroundcolor: 'red',
  };//2
  dato_Antracita = {
    label: "Antracita",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//3
  dato_Grafito = {
    label: "Grafito",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//4
  dato_TotalCarbon = {
    label: "Total Carbón",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//5
  dato_Gasoleo = {
    label: "Gasóleo",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(0,0,0)",
  };//6
  dato_GLP = {
    label: "GLP",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//7
  dato_Oxigeno = {
    label: "Oxígeno",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//8
  dato_espumante = {
    label: "Espumante",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//9
  dato_KwhFusion = {
    label: "KWh fusión",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//10
  dato_TiempoFusion = {
    label: "Tiempo fusión",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(0,0,0)",
  };//11
  dato_KwhAfino = {
    label: "KWh Afino",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//12
  dato_TiempoAfino = {
    label: "Tiempo Afino",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//13
  dato_TiempoTotal = {
    label: "Energía Total",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//14
  dato_PowerON = {
    label: "Power ON",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//15
  dato_PowerOFF = {
    label: "Power OFF",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//16
  dato_Carbon = {
    label: " % Carbón",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//17
  dato_TemperaturaVaciado = {
    label: "Temp. Vaciado",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//18
  dato_TiempoMinutos = {
    label: "Tap to Tap",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//19
  dato_endbrick = {
    label: "Endbrick",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//20
  dato_TiempoVaciado = {
    label: "Tiempo vaciado",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//21
  dato_PrograSmart = {
    label: "PrograSmart",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//22
  dato_PrograDigit = {
    label: "PrograDigit",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//23
  dato_PesoCesta1 = {
    label: "Peso cesta 1",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//24
  dato_PesoCesta2 = {
    label: "Peso cesta 2",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//25
  dato_PesoCesta3 = {
    label: "Peso cesta 3",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//26
  dato_PesoCesta4 = {
    label: "Peso cesta 4",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//27
  dato_PesoCesta5 = {
    label: "Peso cesta 5",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//28
  dato_ColadasHorno = {
    label: "Coladas Horno",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//29
  dato_ColadasDelta = {
    label: "Coladas Delta",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//30
  dato_ColadasElec1 = {
    label: "Coladas Elect 1",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//31
  dato_ColadasElect2 = {
    label: "Coladas Elect 2",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//32
  dato_ColadasElect3 = {
    label: "Coladas Elect 3",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//33
  dato_CalDolomitica = {
    label: "CalDolomitica",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//34
  dato_CalCalcitica = {
    label: "CalCalcitica",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//35
  dato_Kalister = {
    label: "Kalister",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//36
  dato_Torta = {
    label: "Torta",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//37
  dato_TempCentro = {
    label: "Temp. Centro",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//38
  dato_TempEVT = {
    label: "Temp. EVT",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//39
  dato_TempPuerta = {
    label: "Temp. Puerta",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//40
  dato_Temp12 = {
    label: "Temp. 12",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//41
  dato_Temp23 = {
    label: "Temp. 23",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//42
  dato_Temp31 = {
    label: "Temp. 31",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//43

  dato_tmp_sellado = {
    label: "Tiem.Sellado",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//44
  dato_tmp_armado = {
    label: "Tiem.Armado",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//45
  dato_tmp_recargue_1 = {
    label: "T.Recargue1",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//46
  dato_tmp_bov_1r_carga = {
    label: "Bov.Abierta1a",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//47
  dato_tmp_recargue_2 = {
    label: "T.Recargue2",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//48
  dato_tmp_bov_2a_carga = {
    label: "Bov.Abierta2a",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//49
  dato_tmp_recargue_3 = {
    label: "T.Recargue3",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//50
  dato_tmp_bov_3r_carga = {
    label: "Bov.Abierta3a",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//51
  dato_tmp_recargue_4 = {
    label: "T.Recargue4",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//52
  dato_tmp_bov_4a_carga = {
    label: "Bov.Abierta4a",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//53
  dato_especifica_c1 = {
    label: "EspecíficaC1",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//54
  dato_especifica_c2 = {
    label: "EspecíficaC2",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//55
  dato_especifica_c3 = {
    label: "EspecíficaC3",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//56
  dato_especifica_c4 = {
    label: "EspecíficaC4",
    data: [],
    hidden: true,
    backgroundcolor: "rgb(255,159,64)",
  };//57

  coladas: string[] = [];           //1
  fecha: string[] = [];             //2
  hora: string[] = [];              //3
  recargue: string[] = [];          //4
  oxlan: string[] = [];             //5
  tonChatarra: string[] = [];       //6
  m3: string[] = [];                //7
  antracita: string[] = [];         //8
  grafito: string[] = [];           //9
  tcarbon: string[] = [];           //10
  gasoleo: string[] = [];           //11
  glp: string[] = [];               //12
  oxigeno: string[] = [];           //13
  espumante: string[] = [];         //14
  fusion: string[] = [];            //15
  tfusion: string[] = [];           //16
  afino: string[] = [];             //17
  tafino: string[] = [];            //18
  ttotal: string[] = [];            //19
  tonfusion: string[] = [];         //20
  tonafino: string[] = [];          //21
  on: string[] = [];                //22
  off: string[] = [];               //23
  carbon: string[] = [];            //24
  tempVaciado: string[] = [];       //25
  tminutos: string[] = [];          //26
  endbrick: string[] = [];          //27

  cod_grado: string[] = [];         //28
  cod_fundidor: string[] = [];      //29
  cod_jefe: string[] = [];          //30
  hr_inicio: string[] = [];         //31
  temp_vaciado: string[] = [];      //32
  cod_jornada: string[] = [];       //33
  pgr_smart: string[] = [];         //34
  pgr_digit: string[] = [];         //35
  peso_cesta1: string[] = [];       //36
  peso_cesta2: string[] = [];       //37
  peso_cesta3: string[] = [];       //38
  peso_cesta4: string[] = [];       //39
  peso_cesta5: string[] = [];       //40
  col_horno: string[] = [];         //41
  col_delta: string[] = [];         //42
  col_elect1: string[] = [];        //43
  col_elect2: string[] = [];        //44
  col_elect3: string[] = [];        //45
  caldolomitica: string[] = [];     //46
  calcalcitica: string[] = [];      //47
  kalister: string[] = [];          //48
  torta: string[] = [];             //49
  temp_centro: string[] = [];       //50
  temp_evt: string[] = [];          //51
  temp_puerta: string[] = [];       //52
  temp12: string[] = [];            //53
  temp23: string[] = [];            //54
  temp31: string[] = [];            //55

  tmp_sellado: string[] = [];       //56
  tmp_armado: string[] = [];        //57
  tmp_recargue_1: string[] = [];    //58
  tmp_bov_1r_carga: string[] = [];  //59
  tmp_recargue_2: string[] = [];    //60
  tmp_bov_2a_carga: string[] = [];  //61
  tmp_recargue_3: string[] = [];    //62
  tmp_bov_3r_carga: string[] = [];  //63
  tmp_recargue_4: string[] = [];    //64
  tmp_bov_4a_carga: string[] = [];  //65
  especifica_c1: string[] = [];     //66
  especifica_c2: string[] = [];     //67
  especifica_c3: string[] = [];     //68
  especifica_c4: string[] = [];     //69

}
