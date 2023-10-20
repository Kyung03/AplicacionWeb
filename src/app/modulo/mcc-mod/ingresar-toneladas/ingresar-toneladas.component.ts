import { Component, OnInit } from '@angular/core';
import { MccServService } from '../mccServ/mcc-serv.service';
import { formatDate } from '@angular/common';

interface colada {
  numero: number;
  dia: number;
  fecha: string;
  hora: string;
  fechat: string;
  horat: string;
  lingotes: number;
  acero: number;
  peso: number;
}

@Component({
  selector: 'app-ingresar-toneladas',
  templateUrl: './ingresar-toneladas.component.html',
  styleUrls: ['../mcc-mod.component.css']
})
export class IngresarToneladasComponent implements OnInit {

  constructor(public mccServ: MccServService) { }

  fecha_inicio: string = this.mccServ.fecha_actual();
  fecha_final: string = this.mccServ.fecha_actual();

  datos: any;

  coladas_sin: Array<any> = [];
  coladas_con: Array<any> = [];

  in_numColada: any;
  in_diaColada: any;
  in_fecha: any;
  in_hora: any;
  in_horat: any;
  in_fechat: string = '';
  in_lingotes: any;
  in_acero: any;
  in_peso: any;
  in_mov = false;
  array_verificacion: Array<any> = [];

  ngOnInit(): void {
    this.in_numColada = "";
    this.in_diaColada = "";
    this.in_fecha = "";
    this.in_hora = "";
    this.in_horat = "";
    this.in_fechat = "";
    this.in_lingotes = "";
    this.in_acero = "";
    this.in_peso = "";
    this.listar_datos();
  } //  FIN ngOnInit

  seleccion(dato: any, fila_selc: HTMLElement) {
    if (dato.acero == "-" || dato.fechat == "-" || dato.horat == "-") {
      this.in_mov = true;
      this.in_numColada = Object.values(dato)[0];
      this.in_diaColada = Object.values(dato)[1];
      this.in_fecha = Object.values(dato)[2];
      this.in_hora = Object.values(dato)[3];
      this.in_horat = "";
      this.in_fechat = "";
      this.in_lingotes = "";
      this.in_acero = "";
      this.in_peso = "";
    } else {
      this.in_mov = false;
      this.in_numColada = Object.values(dato)[0];
      this.in_diaColada = Object.values(dato)[1];
      this.in_fecha = Object.values(dato)[2];
      this.in_hora = Object.values(dato)[3];
      this.in_horat = Object.values(dato)[4];
      this.in_fechat = dato.horat//formatDate(dato.horat, 'yyyy-MM-dd', 'en-US');
      this.in_lingotes = Object.values(dato)[6];
      this.in_acero = Object.values(dato)[7];
      this.in_peso = Object.values(dato)[8];
    }
    this.destacar_fila(dato, fila_selc);
  } //  FIN seleccion

  destacar_fila(dato: any, fila_selc: HTMLElement) {
    var anterior = {
      datos: dato,
      fila: fila_selc
    };
    this.array_verificacion.push(anterior);
    if (this.array_verificacion.length > 2) {
      this.array_verificacion.splice(0, 1);
    }
    if (this.array_verificacion.length == 1) {
      //  DESTCAR LA NUEVA FILA SELECCIONADA
      if (this.array_verificacion[0].fila != undefined) {
        if (this.array_verificacion[0].fila.style.backgroundColor.trim() == "") {
          this.array_verificacion[0].fila.style.backgroundColor = "lightblue";
        } else {
          this.array_verificacion[0].fila.style.backgroundColor = "";
        }
      }
    }
    if (this.array_verificacion.length == 2) {
      //  QUITAR LO DESTACADO DEL FILA ANTERIOR
      if (this.array_verificacion[0].fila != undefined) {
        this.array_verificacion[0].fila.style.backgroundColor = "";
      }
      //  DESTCAR LA NUEVA FILA SELECCIONADA
      if (this.array_verificacion[1].fila != undefined) {
        if (this.array_verificacion[1].fila.style.backgroundColor.trim() == "") {
          this.array_verificacion[1].fila.style.backgroundColor = "lightblue";
        } else {
          this.array_verificacion[1].fila.style.backgroundColor = "";
        }
      }
    }
  } //  FIN destacar_fila

  btn_guardar() {
    if (this.in_numColada != undefined || this.in_diaColada != undefined || this.in_fecha != undefined
      || this.in_hora != undefined || this.in_horat != undefined || this.in_fechat != undefined
      || this.in_lingotes != undefined || this.in_acero != undefined || this.in_peso != undefined) {

      const datos =
      {
        colada_p: this.in_numColada,
        dia_p: this.in_diaColada,
        fecha_p: this.in_fecha,
        hora_p: this.in_hora,
        fechat_p: this.in_fechat,
        horat_p: this.in_horat,
        ling_p: this.in_lingotes,
        acero_p: this.in_acero,
        peso_p: this.in_peso,
        mov_p: this.in_mov,
      };
      if (this.esp_vacios()) {
        this.mccServ.ingresar_datos(datos).subscribe(resul => {
          if (Object.keys(resul).length != 0) {
            alert('Operacion exitosa');
          } else { console.log('No hay datos'); }
        });
        this.listar_datos();
        this.btn_limpiar();
      }

    } else {
      alert('Dato indefinido');
    }
  } //  FIN btn_guardar

  esp_vacios() {
    var bool = false;
    if (this.in_horat === "" || this.in_fechat === "" || this.in_lingotes === "" || this.in_acero === "" || this.in_peso === "") {
      alert('Espacios Vacios');
    } else {
      bool = true;
    }
    return bool;
  } // FIN esp_vacios

  btn_limpiar() {
    this.in_numColada = "";
    this.in_diaColada = "";
    this.in_fecha = "";
    this.in_hora = "";
    this.in_horat = "";
    this.in_fechat = "";
    this.in_lingotes = "";
    this.in_acero = "";
    this.in_peso = "";
    for (var i = 0; i < this.array_verificacion.length; i++) {
      if (this.array_verificacion[i].fila != undefined) {
        this.array_verificacion[i].fila.style.backgroundColor = "";
      }
    }
    this.array_verificacion = [];
    this.array_verificacion.splice(0);
  } //  FIN btn_limpiar

  listar_datos() {
    this.coladas_con = [];
    this.coladas_sin = [];
    this.coladas_con.splice(0);
    this.coladas_sin.splice(0);
    const fechas = { fecha1: this.fecha_inicio, fecha2: this.fecha_final };
    this.mccServ.listar_datos(fechas).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        this.datos = this.mccServ.toArray(resul);
        this.datos[0].forEach((element: any) => {
          var cont = 0;
          var auxColada = 0;
          var auxDia = 0;
          var auxFecha = "";
          var auxHora = "";
          var auxFechat = "";
          var auxHorat = "";
          var auxLingote = 0;
          var auxPeso = 0;
          var auxAcero = 0;
          if (element[4] == null) {
            element.forEach((element_in: any) => {
              if (element_in == null) element_in = '-';
              switch (cont) {
                case 0: auxColada = element_in;
                  break;
                case 1: auxDia = element_in;
                  break;
                case 2: auxFecha = element_in;
                  break;
                case 3: auxHora = element_in;
                  break;
                case 4: auxFechat = element_in;
                  break;
                case 5: auxHorat = element_in;
                  break;
                case 6: auxLingote = element_in;
                  break;
                case 7: auxAcero = element_in;
                  break;
                case 8: auxPeso = element_in;
                  break;
              }
              cont++;
            });
            var colada_aux: colada = {
              numero: auxColada,
              dia: auxDia,
              fecha: auxFecha,
              hora: auxHora,
              fechat: auxFechat,
              horat: auxHorat,
              lingotes: auxLingote,
              acero: auxAcero,
              peso: auxPeso
            };
            this.coladas_sin.push(colada_aux);
          }
          else {
            element.forEach((element_in: any) => {
              switch (cont) {
                case 0: auxColada = element_in;
                  break;
                case 1: auxDia = element_in;
                  break;
                case 2: auxFecha = element_in;
                  break;
                case 3: auxHora = element_in;
                  break;
                case 4: auxFechat = element_in;
                  break;
                case 5: auxHorat = element_in;
                  break;
                case 6: auxLingote = element_in;
                  break;
                case 7: auxAcero = element_in;
                  break;
                case 8: auxPeso = element_in;
                  break;
              }
              cont++;
            });
            var colada_aux: colada = {
              numero: auxColada,
              dia: auxDia,
              fecha: auxFecha,
              hora: auxHora,
              fechat: auxFechat,
              horat: auxHorat,
              lingotes: auxLingote,
              acero: auxAcero,
              peso: auxPeso
            };
            this.coladas_con.push(colada_aux);
          }
        });
      } else {
        console.log('No hay datos');
      }
    });
  } //  FIN listar_datos

}
