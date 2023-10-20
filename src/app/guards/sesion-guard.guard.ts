import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UsuarioService } from '../login/usuario/usuario.service';
import { Location } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class SesionGuardGuard implements CanActivate {
  constructor(private userService: UsuarioService, private router: Router, private location: Location) {
  }

  verificar = false;
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    console.log('sesion guard');
    const sesion_local = { sesion: this.userService.getTokenLS() };
    
    if (this.userService.getTokenLS()) {
      this.userService.comprobar_sesion(sesion_local).subscribe(resul => {
        console.log(resul["resultado"]);
        switch (resul["resultado"]) {
          default:
            //this.verificar = false;
            return this.router.navigate(['/login']).then(() => this.verificar);
          case '1':
            console.log('case 1');
            this.userService.setUsuario(resul["usuario"]);
            this.userService.setTipo(resul["tipo"]);
            this.userService.setToken(resul["token"]);
            this.verificar = true;
            return this.router.navigate(['/' + resul["url"]]).then(() => this.verificar);
          case '2':
            console.log('case 2: Sin token');
            this.userService.limpiar_cookies();
            return this.router.navigate(['/login']).then(() => this.verificar);
          case '3':
            console.log('case 3: Sesion no iniciada');
            return this.router.navigate(['/login']).then(() => this.verificar);
        }
      });
    } else {
      console.log('no hay cookies');
      return this.router.navigate(['/login']).then(() => this.verificar);
    }
    return this.verificar;
  }

}
