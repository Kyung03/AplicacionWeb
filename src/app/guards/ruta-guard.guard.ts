import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UsuarioService } from '../login/usuario/usuario.service';
import { Location } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class RutaGuardGuard implements CanActivate {

  constructor(private userService: UsuarioService, private router: Router, private location: Location) {
  }

  verificar = false;
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (this.userService.getTipo() == 'eaf') {
      this.verificar = true;
    }else{
      return this.router.navigate(['']).then(() => this.verificar);
    }
    return this.verificar;
  }


}
