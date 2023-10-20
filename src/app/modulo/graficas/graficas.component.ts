import { Component, OnInit } from '@angular/core';
import { Chart } from 'chart.js/auto';

@Component({
  selector: 'app-graficas',
  templateUrl: './graficas.component.html',
  styleUrls: ['./graficas.component.css']
})
export class GraficasComponent implements OnInit {

  constructor() { }

  public grafica: any;

  ngOnInit(): void {
  }

  data =
  {
    label: "Coladas",
    data: [1,2,3,4,5,6,7],
    backgroundColor: 'blue'
  };

  crearGrafica(titulos:any ) {
    this.grafica = new Chart("MiGrafica", {
      type: 'bar',
      data: {
        labels: titulos ,
        datasets: [ this.data ]
      },
      options: {
        aspectRatio: 2.5
      }
    });
  } // fin crearGrafica

  datos(datos:any){
    this.data.data.pop();
    for (var a = 0; a < datos.length; a++) {
      this.data.data.push(datos[a][0].length);
    }/*
    for (var i = 0; i < this.dat['datos'].length; i++) {
      this.grafica.data.data.push(this.dat['datos'][i][0].length);
    }*/
    
  }

  update(){
    this.grafica.update();
  }

}
/**
 * {
            label: "sales",
            data: ['467', '572', '576', '79', '92', '574', '573', '576'],
            backgroundColor: 'blue'
          },
          {
            label: "profit",
            data: ['572', '542', '536', '327', '17', '0.00', '538', '541'],
            backgroundColor: 'limegreen'
          }
 */
