import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReporteHornoComponent } from './reporte-horno.component';

describe('ReporteHornoComponent', () => {
  let component: ReporteHornoComponent;
  let fixture: ComponentFixture<ReporteHornoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ReporteHornoComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ReporteHornoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
