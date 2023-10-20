import { Component, OnInit, ViewChild } from '@angular/core';
import { ColaboradorServService } from '../colaboradorServ/colaborador-serv.service';

interface lista_detalle {
  codigo: string;
  nombre: string;
}

@Component({
  selector: 'app-colaborador-mod',
  templateUrl: './colaborador-mod.component.html',
  styleUrls: ['./colaborador-mod.component.css']
})

export class ColaboradorModComponent implements OnInit {

  constructor(public col_service: ColaboradorServService) { }

  area_array: Array<any> = [];
  jornada_array: Array<any> = [];
  seleccionado: string = "";
  codigo_input: any;
  nombre_input: any;
  puesto_input: any;
  tiempo_semanal_input: any;
  semanas_input: any;
  total_horas_input: any;
  horas_extras_input: any;
  area_input: any;
  jornada_input: any;
  tipo_mov: any;
  input_codigo: boolean = false;

  array_col: Array<any> = [];

  //columnas: string[] = ['codigo','nombre', 'puesto', 'jornada', 'area'];
  pageSize = 5; // Tamaño de la página
  currentPage = 1; // Página actual
  totalItems = 0; // Total de elementos
  totalPages = 0; // Total de páginas

  ngOnInit(): void {
    this.listar_area_jornada();
    this.listar_colaboradores();
    this.tipo_mov = 0;
    this.area_input = 0;
    this.jornada_input = 0;

    //this.dataSource = new MatTableDataSource(this.array_col);
    //this.dataSource.paginator = this.paginator;
  }

  getTotalItems(data_aux:any): number {
    return data_aux.length;
  }

  seleccion(dato: any, fila_selc: HTMLElement): void {
    console.log(dato);
    console.log(fila_selc);
    console.log(Object.values(dato));
    this.codigo_input = Object.values(dato)[0];
    this.nombre_input = Object.values(dato)[1];
    this.puesto_input = Object.values(dato)[2];
    this.jornada_input = Object.values(dato)[3];
    this.area_input = Object.values(dato)[5];
    this.tipo_mov = 1;
    this.input_codigo = true;
    this.destacar_fila(dato, fila_selc);
  }
  array_verificacion: Array<any> = [];

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

  seleccion_area(event: any): void {
    console.log(event.target.value);
  }

  btn_guardar() {
    if (this.codigo_input != undefined || this.nombre_input != undefined ||
      this.puesto_input != undefined || this.tiempo_semanal_input != undefined || this.semanas_input != undefined ||
      this.total_horas_input != undefined || this.horas_extras_input != undefined) {

      const datos =
      {
        codigo_servidor: this.codigo_input,
        nombre_servidor: this.nombre_input,
        puesto_servidor: this.puesto_input,
        //tiempo_semanal_servidor: this.tiempo_semanal_input,
        //semanas_servidor: this.semanas_input,
        //total_horas_servidor: this.total_horas_input,
        //horas_extras_servidor: this.horas_extras_input,
        area_servidor: this.area_input,
        jornada_servidor: this.jornada_input,
        mov_p: this.tipo_mov
      };

      if (this.esp_vacios() && this.validar_select()) {
        console.log(datos);

        this.col_service.ingresar_datos(datos).subscribe(resul => {
          if (Object.keys(resul).length != 0) {
            console.log(resul);
            if (resul['resultado'] == 1) {
              alert('Nuevo ingreso exitoso');
            } else {
              if (resul['resultado'] == 2) {
                alert('Modificacion exitosa');
              } else {
                alert('Hupo un problema');
              }
            }
            this.listar_colaboradores();
          } else { console.log('No hay datos'); }
        });

        this.btn_limpiar();
      }

    } else {
      alert('Dato indefinido');
    }
  }

  esp_vacios() {
    if (this.codigo_input === "" || this.nombre_input === "" || this.puesto_input === ""
      //|| this.tiempo_semanal_input === "" || this.semanas_input === "" ||
      //  this.total_horas_input === "" || this.horas_extras_input === ""
    ) {
      alert('Espacio vacio');
      return false;
    } else {
      return true;
    }
  }

  es_numero() {
    if (typeof this.tiempo_semanal_input != 'number' || typeof this.semanas_input != 'number' ||
      typeof this.total_horas_input !== 'number' || typeof this.horas_extras_input != 'number') {
      alert('Solo ingresar numeros en las casillas');
      return false;
    } else {
      return true;
    }
  }

  validar_select() {
    if (this.area_input == 0 || this.jornada_input == 0) {
      alert("Seleccione una de las opciones");
      return false;
    }
    else {
      return true;
    }
  }

  btn_limpiar() {
    this.codigo_input = "";
    this.nombre_input = "";
    this.puesto_input = "";
    this.tiempo_semanal_input = "";
    this.semanas_input = "";
    this.total_horas_input = "";
    this.horas_extras_input = "";
    this.area_input = 0;
    this.jornada_input = 0;
    this.tipo_mov = 0;
    this.input_codigo = false;
    for (var i = 0; i < this.array_verificacion.length; i++) {
      if (this.array_verificacion[i].fila != undefined) {
        this.array_verificacion[i].fila.style.backgroundColor = "";
      }
    }
    this.array_verificacion = [];
    this.array_verificacion.splice(0);
  }

  listar_area_jornada() {
    var datos = "aaa";
    this.col_service.listar_datos(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {

        console.log(resul);

        for (var i = 0; i < resul["jornada"][0][0].length; i++) {
          var aux: lista_detalle = {
            codigo: resul["jornada"][0][0][i],
            nombre: resul["jornada"][0][1][i]
          };
          this.jornada_array.push(aux);
        }

        for (var i = 0; i < resul["area"][0][0].length; i++) {
          var aux: lista_detalle = {
            codigo: resul["area"][0][0][i],
            nombre: resul["area"][0][1][i]
          };
          this.area_array.push(aux);
        }
      } else { console.log('No hay datos'); }
    });
  }

  listar_colaboradores() {
    var datos = "aaa";
    this.array_col = [];
    this.array_col.slice(0);
    this.col_service.listar_colaboradores(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {

        console.log(resul['colaborador']);
        
        this.array_col = this.paginacion_datos(this.pageSize, this.currentPage, resul['colaborador']);

        //this.array_col = resul['colaborador'];
        this.calculatePagination(resul['colaborador']);

      } else { console.log('No hay datos'); }
    });
  } //

  paginacion_datos(pageSize: number, currentPage: number, data:any) {
    const startIndex = (currentPage - 1) * pageSize;
    const endIndex = startIndex + pageSize;
    const paginatedData = data.slice(startIndex, endIndex);
    console.log(data);
    console.log(paginatedData);
    return (paginatedData);
  }

  calculatePagination(data:any): void {
    // Calcular el total de elementos y el total de páginas
    this.totalItems = this.getTotalItems(data);
    this.totalPages = Math.ceil(this.totalItems / this.pageSize);
  }

  setPage(pageNumber: number): void {
    if (pageNumber >= 1 && pageNumber <= this.totalPages) {
      this.currentPage = pageNumber;
      this.listar_colaboradores();
    }
  }

  nextPage(): void {
    this.setPage(this.currentPage + 1);
  }

  prevPage(): void {
    this.setPage(this.currentPage - 1);
  }

}
