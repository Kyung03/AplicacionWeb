import { Component, OnInit } from '@angular/core';
import { AdmServService } from '../admServ/adm-serv.service';
import { UsuarioService } from '../../../login/usuario/usuario.service';
interface datoColada {
  titulo: string;
  dato: string;
};

interface colada {
  numero: string;
  dia: string;
  fecha: string;
  hora: string;
  recargue: string;
  oxlan: string;
  tonChatarra: string;
  m3: string;
  antracita: string;
  grafito: string;
  tcarbon: string;
  gasoleo: string;
  glp: string;
  oxigeno: string;
  espumante: string;
  fusion: string;
  tfusion: string;
  afino: string;
  tafino: string;
  ttotal: string;
  tonfusion: string;
  tonafino: string;
  on: string;
  off: string;
  carbon: string;
  tempFinal: string;
  tminutos: string;
  endbrick: string;

  cod_grado: string;
  cod_fundidor: string;
  cod_jefe: string;
  hr_inicio: string;
  temp_vaciado: string;
  cod_jornada: string;
  pgr_smart: string;
  pgr_digit: string;
  peso_cesta1: string;
  peso_cesta2: string;
  peso_cesta3: string;
  peso_cesta4: string;
  peso_cesta5: string;
  col_horno: string;
  col_delta: string;
  col_elect1: string;
  col_elect2: string;
  col_elect3: string;
  caldolomitica: string;
  calcalcitica: string;
  kalister: string;
  torta: string;
  temp_centro: string;
  temp_evt: string;
  temp_puerta: string;
  temp12: string;
  temp23: string;
  temp31: string;

  tmp_sellado: string;
  tmp_armado: string;
  tmp_recargue_1: string;
  tmp_bov_1r_carga: string;
  tmp_recargue_2: string;
  tmp_bov_2a_carga: string;
  tmp_recargue_3: string;
  tmp_bov_3r_carga: string;
  tmp_recargue_4: string;
  tmp_bov_4a_carga: string;
  especifica_c1: string;
  especifica_c2: string;
  especifica_c3: string;
  especifica_c4: string;
};

@Component({
  selector: 'app-modificar-colada',
  templateUrl: './modificar-colada.component.html',
  styleUrls: ['../adm-mod.component.css']
})
export class ModificarColadaComponent implements OnInit {

  constructor(public admServ: AdmServService, private userServ: UsuarioService) { }

  seleccionado = false;
  esp_vacios = false;
  esp_undef = false;

  numColada: string = "";
  numColada_bool = false;
  diaColada: string = "";
  diaColada_bool = false;
  fecha: string = "";
  fecha_bool = false;

  datos: any;
  coladas: Array<colada> = [];

  colada_seleccionada = {} as colada;
  colada_modificar = {} as colada;
  array_modificar: Array<datoColada> = [];
  grado: string[] = [];
  jornada: string[] = [];
  jefe: string[] = [];
  fundidor: string[] = [];

  titulos: string[] = [
    '', 'Colada', 'Col.dia', 'Fecha', 'Hora', 'Recargue', 'Ox.Lanceado', 'CargaChatarra',
    'M3Lanceado', 'Antracita', 'Grafito', 'TotalCarbon', 'Gasoleo',
    'GLP', 'Oxigeno', 'Espumante', 'Fusion', 'Tiem.Fusion', 'Afino',
    'Tiem.Afino', 'Ener.Total', 'Ton/Fusion', 'Ton/Afino', 'PowerOn',
    'PowerOff', '%Carbon', 'Temp.Final', 'Tiem.Minutos', 'Endbrick',
    'Grado', 'Fundidor', 'Jefe', 'Hr.Inicio', 'Temp.Vaciado',
    'Jornada', 'PGRSmart', 'PGRDigit', 'PesoCesta1', 'PesoCesta2',
    'PesoCesta3', 'PesoCesta4', 'PesoCesta5', 'Col.Horno', 'Col.Delta',
    'Col.Elect1', 'Col.Elect2', 'Col.Elect3', 'Caldolomitica',
    'Calcalcitica', 'Kalister', 'Torta', 'Temp.Centro', 'Temp.EVT',
    'Temp.Puerta', 'Temp.12', 'Temp.23', 'Temp.31', 'Sellado',
    'Armado', 'T.Recargue1', 'Bov.Abierta1a',
    'T.Recargue2', 'Bov.Abierta2a', 'T.Recargue3',
    'Bov.Abierta3a', 'T.Recargue4', 'Bov.Abierta4a',
    'EspecificaC1', 'EspecificaC2', 'EspecificaC3', 'EspecificaC4'
  ];

  ngOnInit(): void {
    this.informacion_operacion();
  } // FIN ngOnInit

  verificacion_inputs() {
    if (Object.values(this.colada_modificar).length == 0) {
      this.esp_vacios = true;
      this.esp_undef = true;
    } else {
      Object.values(this.colada_modificar).forEach(element => {
        if (element == undefined) { this.esp_undef = true; console.log('indefinido: ' + element); }
        if (String(element) == "") { this.esp_vacios = true; console.log('vacio: ' + element); }
      });
    }
  } // FIN verificacion_inputs

  guardar() {
    this.verificacion_inputs();
    if (this.esp_undef) {
      alert('Dato indefinido');
    } else {
      if (this.esp_vacios) {
        alert('Espacios vacios');
      } else {
        this.comparacion();
        const datos =
        {
          col_mod: this.array_modificar,
          numColada: this.colada_modificar.numero,
          usuario: this.userServ.getUsuario()
        };
        console.log(this.array_modificar);
        this.admServ.adm_guardar_datos(datos).subscribe(resul => {
          if (Object.keys(resul).length != 0) {
            switch (resul['resul']) {
              case 0:
                alert(resul['error']);
                break;
              case 1:
                alert('Operacion exitosa');
                break;
            }
          } else { console.log('No hay datos'); }
        });
        // LIMPIAR EL ARRAY DE DATOS A MODIFICAR
        this.listar_datos();
        this.limpiar();
        this.array_modificar = [];
        this.array_modificar.splice(0);
        this.limpiar();
      }
    }
  } // FIN guardar

  comparacion() {
    var i = 0;
    Object.values(this.colada_modificar).forEach(element => {
      if (element != Object.values(this.colada_seleccionada)[i]) {
        var aux: datoColada = {
          titulo: Object.keys(this.colada_seleccionada)[i],
          dato: element
        };
        this.array_modificar.push(aux);
      }
      i++;
    });
  } // FIN comparacion

  toArray(item: any) {
    return Object.keys(item).map(key => item[key]);
  } // FIN toArray

  seleccion(colada_tabla: any) {
    Object.assign(this.colada_modificar, colada_tabla);
    Object.assign(this.colada_seleccionada, colada_tabla);
    this.set_select("lista_grado", colada_tabla['cod_grado']);
    this.set_select("lista_fundidor", colada_tabla['cod_fundidor']);
    this.set_select("lista_jefe", colada_tabla['cod_jefe']);
    this.set_select("lista_jornada", colada_tabla['cod_jornada']);
  } // FIN seleccion

  limpiar() {
    this.colada_modificar = {} as colada;
    this.colada_seleccionada = {} as colada;
  } // FIN limpiar

  listar_datos() {
    if (this.numColada != "") {
      this.numColada_bool = true;
    }
    if (this.diaColada != "") {
      this.diaColada_bool = true;
    }
    if (this.fecha != "") {
      this.fecha_bool = true;
    }
    this.coladas = [];
    this.coladas.splice(0);

    const datos =
    {
      numColada_p: this.numColada,
      coladaDia_p: this.diaColada,
      fecha_p: this.fecha,
      numColada_bool_p: this.numColada_bool,
      diaColada_bool_p: this.diaColada_bool,
      fecha_bool_p: this.fecha_bool
    };
    this.admServ.adm_listar_datos(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        //console.log(resul);
        this.datos = this.admServ.toArray(resul);
        this.datos[0].forEach((element: any) => {
          var cont = 0;

          var aux_numero = "";
          var aux_dia = "";
          var aux_fecha = "";
          var aux_hora = "";
          var aux_recargue = "";
          var aux_oxlan = "";
          var aux_tonChatarra = "";
          var aux_m3 = "";
          var aux_antracita = "";
          var aux_grafito = "";
          var aux_tcarbon = "";
          var aux_gasoleo = "";
          var aux_glp = "";
          var aux_oxigeno = "";
          var aux_espumante = "";
          var aux_fusion = "";
          var aux_tfusion = "";
          var aux_afino = "";
          var aux_tafino = "";
          var aux_ttotal = "";
          var aux_tonfusion = "";
          var aux_tonafino = "";
          var aux_on = "";
          var aux_off = "";
          var aux_carbon = "";
          var aux_tempFinal = "";
          var aux_tminutos = "";
          var aux_endbrick = "";

          var aux_cod_grado = "";
          var aux_cod_fundidor = "";
          var aux_cod_jefe = "";
          var aux_hr_inicio = "";
          var aux_temp_vaciado = "";
          var aux_cod_jornada = "";
          var aux_pgr_smart = "";
          var aux_pgr_digit = "";
          var aux_peso_cesta1 = "";
          var aux_peso_cesta2 = "";
          var aux_peso_cesta3 = "";
          var aux_peso_cesta4 = "";
          var aux_peso_cesta5 = "";
          var aux_col_horno = "";
          var aux_col_delta = "";
          var aux_col_elect1 = "";
          var aux_col_elect2 = "";
          var aux_col_elect3 = "";
          var aux_caldolomitica = "";
          var aux_calcalcitica = "";
          var aux_kalister = "";
          var aux_torta = "";
          var aux_temp_centro = "";
          var aux_temp_evt = "";
          var aux_temp_puerta = "";
          var aux_temp12 = "";
          var aux_temp23 = "";
          var aux_temp31 = "";

          var aux_tmp_sellado = "";
          var aux_tmp_armado = "";
          var aux_tmp_recargue_1 = "";
          var aux_tmp_bov_1r_carga = "";
          var aux_tmp_recargue_2 = "";
          var aux_tmp_bov_2a_carga = "";
          var aux_tmp_recargue_3 = "";
          var aux_tmp_bov_3r_carga = "";
          var aux_tmp_recargue_4 = "";
          var aux_tmp_bov_4a_carga = "";
          var aux_especifica_c1 = "";
          var aux_especifica_c2 = "";
          var aux_especifica_c3 = "";
          var aux_especifica_c4 = "";
          //
          element.forEach((element_in: any) => {
            if (element_in == null) element_in = 0;
            switch (cont) {
              case 0: aux_numero = element_in; break;
              case 1: aux_dia = element_in; break;
              case 2: aux_fecha = element_in; break;
              case 3: aux_hora = element_in; break;
              case 4: aux_recargue = element_in; break;
              case 5: aux_oxlan = element_in; break;
              case 6: aux_tonChatarra = element_in; break;
              case 7: aux_m3 = element_in; break;
              case 8: aux_antracita = element_in; break;
              case 9: aux_grafito = element_in; break;
              case 10: aux_tcarbon = element_in; break;
              case 11: aux_gasoleo = element_in; break;
              case 12: aux_glp = element_in; break;
              case 13: aux_oxigeno = element_in; break;
              case 14: aux_espumante = element_in; break;
              case 15: aux_fusion = element_in; break;
              case 16: aux_tfusion = element_in; break;
              case 17: aux_afino = element_in; break;
              case 18: aux_tafino = element_in; break;
              case 19: aux_ttotal = element_in; break;
              case 20: aux_tonfusion = element_in; break;
              case 21: aux_tonafino = element_in; break;
              case 22: aux_on = element_in; break;
              case 23: aux_off = element_in; break;
              case 24: aux_carbon = element_in; break;
              case 25: aux_tempFinal = element_in; break;
              case 26: aux_tminutos = element_in; break;
              case 27: aux_endbrick = element_in; break;

              case 28: aux_cod_grado = element_in; break;
              case 29: aux_cod_fundidor = element_in; break;
              case 30: aux_cod_jefe = element_in; break;
              case 31: aux_hr_inicio = element_in; break;
              case 32: aux_temp_vaciado = element_in; break;
              case 33: aux_cod_jornada = element_in; break;
              case 34: aux_pgr_smart = element_in; break;
              case 35: aux_pgr_digit = element_in; break;
              case 36: aux_peso_cesta1 = element_in; break;
              case 37: aux_peso_cesta2 = element_in; break;
              case 38: aux_peso_cesta3 = element_in; break;
              case 39: aux_peso_cesta4 = element_in; break;
              case 40: aux_peso_cesta5 = element_in; break;
              case 41: aux_col_horno = element_in; break;
              case 42: aux_col_delta = element_in; break;
              case 43: aux_col_elect1 = element_in; break;
              case 44: aux_col_elect2 = element_in; break;
              case 45: aux_col_elect3 = element_in; break;
              case 46: aux_caldolomitica = element_in; break;
              case 47: aux_calcalcitica = element_in; break;
              case 48: aux_kalister = element_in; break;
              case 49: aux_torta = element_in; break;
              case 50: aux_temp_centro = element_in; break;
              case 51: aux_temp_evt = element_in; break;
              case 52: aux_temp_puerta = element_in; break;
              case 53: aux_temp12 = element_in; break;
              case 54: aux_temp23 = element_in; break;
              case 55: aux_temp31 = element_in; break;

              case 56: aux_tmp_sellado = element_in; break;
              case 57: aux_tmp_armado = element_in; break;
              case 58: aux_tmp_recargue_1 = element_in; break;
              case 59: aux_tmp_bov_1r_carga = element_in; break;
              case 60: aux_tmp_recargue_2 = element_in; break;
              case 61: aux_tmp_bov_2a_carga = element_in; break;
              case 62: aux_tmp_recargue_3 = element_in; break;
              case 63: aux_tmp_bov_3r_carga = element_in; break;
              case 64: aux_tmp_recargue_4 = element_in; break;
              case 65: aux_tmp_bov_4a_carga = element_in; break;
              case 66: aux_especifica_c1 = element_in; break;
              case 67: aux_especifica_c2 = element_in; break;
              case 68: aux_especifica_c3 = element_in; break;
              case 69: aux_especifica_c4 = element_in; break;
            }
            cont++;
          });
          var colada_aux: colada = {
            numero: aux_numero,
            dia: aux_dia,
            fecha: aux_fecha,
            hora: aux_hora,
            recargue: aux_recargue,
            oxlan: aux_oxlan,
            tonChatarra: aux_tonChatarra,
            m3: aux_m3,
            antracita: aux_antracita,
            grafito: aux_grafito,
            tcarbon: aux_tcarbon,
            gasoleo: aux_gasoleo,
            glp: aux_glp,
            oxigeno: aux_oxigeno,
            espumante: aux_espumante,
            fusion: aux_fusion,
            tfusion: aux_tfusion,
            afino: aux_afino,
            tafino: aux_tafino,
            ttotal: aux_ttotal,
            tonfusion: aux_tonfusion,
            tonafino: aux_tonafino,
            on: aux_on,
            off: aux_off,
            carbon: aux_carbon,
            tempFinal: aux_tempFinal,
            tminutos: aux_tminutos,
            endbrick: aux_endbrick,

            cod_grado: aux_cod_grado,
            cod_fundidor: aux_cod_fundidor,
            cod_jefe: aux_cod_jefe,
            hr_inicio: aux_hr_inicio,
            temp_vaciado: aux_temp_vaciado,
            cod_jornada: aux_cod_jornada,
            pgr_smart: aux_pgr_smart,
            pgr_digit: aux_pgr_digit,
            peso_cesta1: aux_peso_cesta1,
            peso_cesta2: aux_peso_cesta2,
            peso_cesta3: aux_peso_cesta3,
            peso_cesta4: aux_peso_cesta4,
            peso_cesta5: aux_peso_cesta5,
            col_horno: aux_col_horno,
            col_delta: aux_col_delta,
            col_elect1: aux_col_elect1,
            col_elect2: aux_col_elect2,
            col_elect3: aux_col_elect3,
            caldolomitica: aux_caldolomitica,
            calcalcitica: aux_calcalcitica,
            kalister: aux_kalister,
            torta: aux_torta,
            temp_centro: aux_temp_centro,
            temp_evt: aux_temp_evt,
            temp_puerta: aux_temp_puerta,
            temp12: aux_temp12,
            temp23: aux_temp23,
            temp31: aux_temp31,

            tmp_sellado: aux_tmp_sellado,
            tmp_armado: aux_tmp_armado,
            tmp_recargue_1: aux_tmp_recargue_1,
            tmp_bov_1r_carga: aux_tmp_bov_1r_carga,
            tmp_recargue_2: aux_tmp_recargue_2,
            tmp_bov_2a_carga: aux_tmp_bov_2a_carga,
            tmp_recargue_3: aux_tmp_recargue_3,
            tmp_bov_3r_carga: aux_tmp_bov_3r_carga,
            tmp_recargue_4: aux_tmp_recargue_4,
            tmp_bov_4a_carga: aux_tmp_bov_4a_carga,
            especifica_c1: aux_especifica_c1,
            especifica_c2: aux_especifica_c2,
            especifica_c3: aux_especifica_c3,
            especifica_c4: aux_especifica_c4,
          };
          this.coladas.push(colada_aux);

        });
      } else {
        console.log('No hay datos');
      }

    });
    this.numColada_bool = false;
    this.diaColada_bool = false;
    this.fecha_bool = false;
  } // FIN listar_datos

  set_select(select: string, dato: string) {
    var lista_select = (document.getElementById(select)) as HTMLSelectElement;
    var sel = lista_select.selectedIndex;
    var valor = lista_select.options[sel];
    (<HTMLOptionElement>valor).value = dato;
    (<HTMLOptionElement>valor).text = dato;
  } // FIN set_select


  informacion_operacion() {
    const dat = { fecha1: "" };
    this.admServ.adm_info_op(dat).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        this.grado = resul['grado'][0];
        this.jornada = resul['jornada'][0];
        this.jefe = resul['jefe_turno'][0];
        this.fundidor = resul['fundidor'][0];
      } else {
        console.log('No hay datos');
      }
    });
  } // FIN informacion_operacion

}
