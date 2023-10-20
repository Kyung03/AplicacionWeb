import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EafReporteComponent } from './eaf-mod.component';

describe('EafReporteComponent', () => {
  let component: EafReporteComponent;
  let fixture: ComponentFixture<EafReporteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EafReporteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EafReporteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
