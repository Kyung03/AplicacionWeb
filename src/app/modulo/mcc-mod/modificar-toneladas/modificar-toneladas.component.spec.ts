import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModificarToneladasComponent } from './modificar-toneladas.component';

describe('ModificarToneladasComponent', () => {
  let component: ModificarToneladasComponent;
  let fixture: ComponentFixture<ModificarToneladasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModificarToneladasComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModificarToneladasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
