import { Component, OnInit, ViewChild, AfterViewInit } from '@angular/core';
import { TareaServService } from '../tareaServ/tarea-serv.service';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';

interface tarea {
  codigo: any;
  nombre: any;
  tipo: any;
  duracion: any;
}

@Component({
  selector: 'app-tarea-mod',
  templateUrl: './tarea-mod.component.html',
  styleUrls: ['./tarea-mod.component.css']
})

export class TareaModComponent implements OnInit {

  displayedColumns: string[] = ['codigo', 'nombre', 'tipo', 'duracion'];
  dataSource!: MatTableDataSource<any>;

  @ViewChild(MatPaginator)
  paginator!: MatPaginator;
  @ViewChild(MatSort)
  sort: MatSort = new MatSort;

  constructor(public tarea_serv: TareaServService) {
    //const users = Array.from({ length: 100 }, (_, k) => createNewUser(k + 1));
    //this.listar_tareas();
    // Assign the data to the data source for the table to render
    //this.dataSource = new MatTableDataSource(users);
    //this.dataSource = new MatTableDataSource<any>([]);
    //this.listar_tareas();
  }

  input_codigoTarea: any;
  input_nombreTarea: any;
  input_tipoTarea: any;
  input_duracionTarea: any;
  tareas_array: Array<tarea> = [];
  array: Array<any> = [];
  tipo_mov: any;
  codigo_deshabilitado: boolean = false;
  array_aux: Array<any> = [];
  pageSize = 5; // Tamaño de la página
  currentPage = 1; // Página actual
  totalItems = 0; // Total de elementos
  totalPages = 0; // Total de páginas

  ngOnInit(): void
  //ngAfterViewInit() 
  {
    this.listar_tareas();
    //this.dataSource.paginator = this.paginator;
    //this.dataSource.sort = this.sort;

    this.input_codigoTarea = "";
    this.input_nombreTarea = "";
    this.input_tipoTarea = 0;
    this.input_duracionTarea = 0;
    this.tipo_mov = 0;
    //this.listar_tareas();
  }

  btn_guardar() {
    var inputs: Array<any> = [
      this.input_codigoTarea,
      this.input_nombreTarea,
      this.input_tipoTarea,
      this.input_duracionTarea
    ];
    const datos =
    {
      codigoTarea_servidor: this.input_codigoTarea,
      nombreTarea_servidor: this.input_nombreTarea,
      tipoTarea_servidor: this.input_tipoTarea,
      duracionTarea_servidor: this.input_duracionTarea,
      mov_p: this.tipo_mov
    };
    if (this.comprobacion_vacio(inputs) || this.input_tipoTarea != 0) {
      this.tarea_serv.ingresar_datos(datos).subscribe(resul => {
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
          this.listar_tareas();
        } else { console.log('No hay datos'); }
      });
      this.btn_limpiar();
    } else {
      alert("Espacios vacios");
    }
  }

  listar_tareas() {
    var datos = "aaa";
    //this.array_col = [];
    //this.array_col.slice(0);
    this.tarea_serv.listar_tareas(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        //console.log(resul['tarea']);
        //this.array = resul['tarea'];
        //this.dataSource = resul['tarea'];
        //this.dataSource.paginator = this.paginator;
        //this.dataSource.sort = this.sort;
        //console.log(this.dataSource);
        //this.array_col = resul['colaborador'];
        this.array = this.paginacion_datos(this.pageSize, this.currentPage, resul['tarea']);
        this.calculatePagination(resul['tarea']);

      } else { console.log('No hay datos'); }
    });
  }

  seleccion(dato: any, fila_selc: HTMLElement): void {
    console.log(dato);
    console.log(fila_selc);
    this.input_codigoTarea = Object.values(dato)[0];
    this.input_nombreTarea = Object.values(dato)[1];
    this.input_tipoTarea = Object.values(dato)[2];
    this.input_duracionTarea = Object.values(dato)[3];
    this.tipo_mov = 1;
    this.codigo_deshabilitado = true;
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

  btn_limpiar() {
    this.input_codigoTarea = "";
    this.input_nombreTarea = "";
    this.input_tipoTarea = 0;
    this.input_duracionTarea = "";
    this.tipo_mov = 0;
    this.codigo_deshabilitado = false;
    for (var i = 0; i < this.array_verificacion.length; i++) {
      if (this.array_verificacion[i].fila != undefined) {
        this.array_verificacion[i].fila.style.backgroundColor = "";
      }
    }
    this.array_verificacion = [];
    this.array_verificacion.splice(0);
  }

  comprobacion_vacio(array_input: any): boolean {
    var comprobacion: boolean = true;
    array_input.forEach((element: any) => {
      if (element == "" || element.trim() == "" || element.trimEnd() == "" || element.trimStart() == "") {
        comprobacion = false;
      }
    });
    return comprobacion;
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }

  paginacion_datos(pageSize: number, currentPage: number, data:any) {
    const startIndex = (currentPage - 1) * pageSize;
    const endIndex = startIndex + pageSize;
    const paginatedData = data.slice(startIndex, endIndex);
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
      this.listar_tareas();
    }
  }

  nextPage(): void {
    this.setPage(this.currentPage + 1);
  }

  prevPage(): void {
    this.setPage(this.currentPage - 1);
  }

  getTotalItems(data_aux:any): number {
    return data_aux.length;
  }

}