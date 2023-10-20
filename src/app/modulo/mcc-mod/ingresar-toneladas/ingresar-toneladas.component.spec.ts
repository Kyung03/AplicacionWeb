import { ComponentFixture, TestBed } from '@angular/core/testing';

import { IngresarToneladasComponent } from './ingresar-toneladas.component';

describe('IngresarToneladasComponent', () => {
  let component: IngresarToneladasComponent;
  let fixture: ComponentFixture<IngresarToneladasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ IngresarToneladasComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(IngresarToneladasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
