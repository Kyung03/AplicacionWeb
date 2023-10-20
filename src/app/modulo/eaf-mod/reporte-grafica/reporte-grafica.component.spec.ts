import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReporteGraficaComponent } from './reporte-grafica.component';

describe('ReporteGraficaComponent', () => {
  let component: ReporteGraficaComponent;
  let fixture: ComponentFixture<ReporteGraficaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ReporteGraficaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ReporteGraficaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
