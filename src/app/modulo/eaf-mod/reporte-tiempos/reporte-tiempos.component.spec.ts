import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReporteTiemposComponent } from './reporte-tiempos.component';

describe('ReporteTiemposComponent', () => {
  let component: ReporteTiemposComponent;
  let fixture: ComponentFixture<ReporteTiemposComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ReporteTiemposComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ReporteTiemposComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
