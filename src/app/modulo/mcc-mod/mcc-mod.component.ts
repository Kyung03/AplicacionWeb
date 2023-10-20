import { Component, OnInit } from '@angular/core';
@Component({
  selector: 'app-mcc-mod',
  templateUrl: './mcc-mod.component.html',
  styleUrls: ['./mcc-mod.component.css']
})
export class MccModComponent implements OnInit {

  constructor() { }
  usuario: string = "";
  tipo: string = "";
  ngOnInit(): void {
  }
}
