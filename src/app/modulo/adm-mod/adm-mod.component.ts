import { Component, OnInit } from '@angular/core';
import { UsuarioService } from "../../login/usuario/usuario.service";
import { Router } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-adm-mod',
  templateUrl: './adm-mod.component.html',
  styleUrls: ['./adm-mod.component.css']
})
export class AdmModComponent implements OnInit {

  constructor(public userService: UsuarioService, public router: Router, private location: Location) { }
  usuario: string = "";
  tipo: string = "";
  ngOnInit(): void {
  }

}
