import { OnInit, Component, ChangeDetectorRef } from '@angular/core';
import { CalendarioServService } from '../calendarioServ/calendario-serv.service';
import { MatDialog } from '@angular/material/dialog';
import { CdkDragDrop, moveItemInArray } from '@angular/cdk/drag-drop';

export interface tarea_asignada {
  codigo: string;
  duracion: string;
  nombre: string;
  tipo: string;
}
export interface colaborador {
  area: number;
  codigo: string;
  jornada: string;
  nombre: string;
  puesto: string;
  tareas: tarea_asignada[];
}

@Component({
  selector: 'app-calendario-mod',
  templateUrl: './calendario-mod.component.html',
  styleUrls: ['./calendario-mod.component.css']
})

export class CalendarioModComponent implements OnInit {

  constructor(public calendario_serv: CalendarioServService, public dialog: MatDialog, private cdr: ChangeDetectorRef) {
    this.asignacion.tarea = "0";
  }

  array_tareas: Array<any> = [];
  array_colab: Array<any> = [];
  array_semanas = ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
  array_asignados: Array<tarea_asignada> = [{ codigo: "0", duracion: "0", nombre: "Sin asignar", tipo: "na" }];
  colaboradorSeleccionado: any;
  asignacion = {
    colaborador: "",
    cod_colaborador: "",
    tarea: ""
  }
  tipo_mov: any = 0;
  tarea_detalle_codigo: any = "";
  tarea_detalle_nombre: any = "";
  tarea_detalle_tipo: any = "";
  tarea_detalle_duracion: any = "";

  aux: Array<any> = [];

  area_input: any = 0;
  area_array: Array<any> = [];
  jornada_input: any = 0;
  jornada_array: Array<any> = [];

  colaborador_tipo_vista: any = 0;
  array_colab_copia: Array<any> = [];
  fecha_asignacion: any = this.fecha_actual();

  ngOnInit() {
    this.listar_colaboradores();
    this.listar_tareas();
    this.listar_area();
    this.listar_jornada();
    //this.area_input = 0;
    //this.jornada_input = 0;


  }

  fecha_actual() {
    var date = new Date();
    var dia = String(date.getDate()).padStart(2, '0');
    var mes = String(date.getMonth() + 1).padStart(2, '0');
    var anio = date.getFullYear();
    var fecha = anio + '-' + mes + '-' + dia;
    return fecha;
  }

  seleccion(event: any, accion: any) {
    switch (accion) {
      case 1: this.area_input = event.target.value;
        break;
      case 2: this.jornada_input = event.target.value;
        break;
    }
    if (this.jornada_input == 0 && this.area_input == 0) {
      //this.colaborador_tipo_vista = 0;
      this.listar_colaboradores();
    } else {
      //this.colaborador_tipo_vista = 1;
      this.listar_colaboradores_seleccion();
    }
  }

  seleccion_jornada(event: any) {
    this.jornada_input = event.target.value;
    console.log(event.target.value);
    if (this.jornada_input == 0 && this.area_input == 0) {
      //this.colaborador_tipo_vista = 0;
      this.listar_colaboradores();
    } else {
      //this.colaborador_tipo_vista = 1;
      this.listar_colaboradores_seleccion();
    }
  }

  dropp(event: CdkDragDrop<string[]>) {
    if (this.colaboradorSeleccionado) {
      console.log(this.colaboradorSeleccionado);
      // Utiliza this.colaboradorSeleccionado.tareas para acceder a las tareas del colaborador
      moveItemInArray(this.colaboradorSeleccionado.tareas, event.previousIndex, event.currentIndex);
    }
    //moveItemInArray(this.array_asignados, event.previousIndex, event.currentIndex);
  }

  seleccionarColaborador(colaborador: any) {
    // Asigna el colaborador seleccionado a la variable colaboradorSeleccionado
    this.colaboradorSeleccionado = colaborador;
  }

  tarea_detalles(dato: any) {
    this.tarea_detalle_codigo = dato.codigo;
    this.tarea_detalle_nombre = dato.nombre;
    this.tarea_detalle_tipo = dato.tipo;
    this.tarea_detalle_duracion = dato.duracion;
  }

  asignar_tarea(dato: any) {
    if (this.asignacion.tarea != "0") {
      var tarea = {
        codigo_tarea: this.tarea_detalle_codigo,
        duracion_tarea: this.tarea_detalle_duracion,
        nombre_tarea: this.tarea_detalle_nombre,
        tipo_tarea: this.tarea_detalle_tipo
      }
      this.array_colab.find(colaborador => colaborador.codigo === dato).tareas.push(tarea);
      this.cdr.detectChanges();
      this.limpiar_seleccion();
    } else {
      alert("Espacios vacios");
    }
  }

  eliminar_tarea(codigo_tarea_p: any, codigo_colab_p: any) {
    this.aux = this.array_colab.find(c => c.codigo === codigo_colab_p).tareas;//.find(tarea=> tarea.codigo === codigo_tarea_p);

    const index = this.aux.findIndex(elemento => elemento.codigo_tarea === codigo_tarea_p);

    if (index !== -1) {
      this.aux.splice(index, 1);
      console.log(`Elemento con ID ${codigo_tarea_p} eliminado. Nuevo array:`, this.aux);
      this.cdr.detectChanges();
      this.aux = [];
      this.aux.slice(0);
    } else {
      console.log(this.aux);
      console.log(index);
      console.log(`No se encontró un elemento con ID ${codigo_tarea_p} en el array.`);
    }

  }

  prueba() {
    console.log(this.array_colab);
    var j = 0;
    this.array_colab.forEach(colaborador => {
      console.log(colaborador);
      for (let i = 0; i < colaborador.tareas.length; i++) {
        const obj1 = colaborador.tareas[i];
        const obj2 = this.array_colab_copia[j].tareas[i];

        console.log(obj1);
        console.log(obj2);
        // Puedes ajustar esto según las propiedades que quieras comparar
        if (JSON.stringify(obj1) != JSON.stringify(obj2)) {
          //return false;
          console.log("funciono");
          console.log(colaborador);
          console.log(obj1);
          console.log(obj2);
        } else { console.log("a"); }
      }
      j++;
    });
  }

  guardar_asignacion() {
    //console.log(elemento);
    
    const datos =
    {
      //codigoTarea_servidor: this.asignacion.tarea,
      colab_array_servidor: this.array_colab,
      mov_p: this.tipo_mov,
      fecha: this.fecha_asignacion
    };
    console.log(datos);
    if (this.asignacion.tarea == "0") {
      this.calendario_serv.ingresar_asignacion(datos).subscribe(resul => {
        if (Object.keys(resul).length != 0) {
          console.log(resul);
          if (resul['resultado'] == 2) {
            alert('Nuevo ingreso exitoso');
          } else {
            if (resul['resultado'] == 1) {
              alert('Modificacion exitosa');
            } else {
              alert('Hupo un problema');
            }
          }
          //this.listar_colaboradores();
        } else { console.log('No hay datos'); }
      });
      this.limpiar_seleccion();
    } else {
      alert("Espacios vacios");
    }
    //this.limpiar_seleccion();
  }

  colaborador_seleccionado(elemento: any) {
    console.log(elemento);
    this.asignacion.colaborador = elemento.nombre;
    this.asignacion.cod_colaborador = elemento.codigo;
    console.log(this.asignacion.colaborador);
  }

  limpiar_seleccion() {
    this.asignacion.colaborador = "";
    this.asignacion.tarea = "0";

    this.tarea_detalle_codigo = "";
    this.tarea_detalle_nombre = "";
    this.tarea_detalle_duracion = "";
    this.tarea_detalle_tipo = "";
  }

  listar_tareas() {
    var datos = "aaa";
    //this.array_col = [];
    //this.array_col.slice(0);
    this.calendario_serv.listar_tareas(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {

        console.log(resul['tarea']);
        this.array_tareas = resul['tarea'];
        //this.array = resul['tarea'];
        //this.array_col = resul['colaborador'];

      } else { console.log('No hay datos'); }
    });
  } //  FIN listar_tareas()

  listar_colaboradores() {
    var datos = {
      fecha: this.fecha_asignacion
    };
    //this.array_col = [];
    //this.array_col.slice(0);
    this.calendario_serv.listar_colaboradores(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {

        //console.log(resul['colaborador']);
        //this.array = resul['tarea'];
        this.array_colab = resul['colaborador'];
        this.array_colab_copia = resul['colaborador'];

        //this.array_asignados = resul['colaborador']['tarea'];

      } else { console.log('No hay datos'); }
    });
  } // FIN listar_colaboradores()

  listar_colaboradores_seleccion() {
    var datos = {
      area_input_servidor: this.area_input,
      jornada_input_servidor: this.jornada_input,
      fecha: this.fecha_asignacion
    };
    //this.array_col = [];
    //this.array_col.slice(0);
    this.calendario_serv.listar_colaboradores_seleccion(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {

        console.log(resul['colaborador']);
        this.array_colab = resul['colaborador'];
        this.array_colab_copia = resul['colaborador'];

      } else { console.log('No hay datos'); }
    });
  } // FIN listar_colaboradores()

  listar_area() {
    var datos = "aaa";
    this.calendario_serv.listar_area(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        console.log(resul['area']);
        this.area_array = resul['area'];
      } else { console.log('No hay datos'); }
    });
  } // FIN listar_area()

  listar_jornada() {
    var datos = "aaa";
    this.calendario_serv.listar_jornada(datos).subscribe(resul => {
      if (Object.keys(resul).length != 0) {
        console.log(resul['jornada']);
        this.jornada_array = resul['jornada'];
      } else { console.log('No hay datos'); }
    });
  } // FIN listar_jornada()

} //FIN class CalendarioModComponent()
