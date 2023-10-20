import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EafModalService {

  constructor() { }

  private display: BehaviorSubject<'open' | 'close'> = new BehaviorSubject<'open' | 'close'>('close');
  cond:any

  watch(): Observable<'open' | 'close'> {
    return this.display.asObservable();
  }

  open(cond_p:any) {
    this.cond = cond_p;
    this.display.next('open');
  }

  getCond(){
    return this.cond;
  }

  close() {
    this.display.next('close');
  }

}
