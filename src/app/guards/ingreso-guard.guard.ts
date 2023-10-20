import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UsuarioService } from '../login/usuario/usuario.service';
import { Location } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class IngresoGuardGuard implements CanActivate {

  constructor(private userService: UsuarioService, private router: Router, private location: Location) {
  }

  verificar = true;

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    console.log('ingreso guard');
    if ( this.userService.cookies_existencias("token") && this.userService.checkTokenLS()) {
      this.verificar = true;
      switch (this.userService.getTipo()) {
        case "administrador":
          return this.router.navigate(['/adm']).then(() => this.verificar);
        case "eaf":
          return this.router.navigate(['/eaf']).then(() => this.verificar);
        case "mcc":
          return this.router.navigate(['/mcc']).then(() => this.verificar);
      }
    } else {
      this.verificar = true;
      //return this.router.navigate(['']).then(() => this.verificar);
    }
    return this.verificar;
  }

}
