import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ModalService {

  constructor() { }

  private display: BehaviorSubject<'open' | 'close'> = new BehaviorSubject<'open' | 'close'>('close');
  public ingreso_bool = false;
  datos_ingreso:any

  watch(): Observable<'open' | 'close'> {
    return this.display.asObservable();
  }

  open(datos:any) {
    this.datos_ingreso = datos;
    this.display.next('open');
  }

  nuevo_ingreso(){
    this.ingreso_bool = true;
    this.comprobar_ingreso();
    this.display.next('close');
  }

  getDatos(){
    return this.datos_ingreso;
  }

  comprobar_ingreso( ){
    if(this.ingreso_bool){
      return true;
    }else{
      return false;
    }
  }

  close() {
    this.display.next('close');
  }

}
