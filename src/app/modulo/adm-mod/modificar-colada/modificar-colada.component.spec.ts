import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModificarColadaComponent } from './modificar-colada.component';

describe('ModificarColadaComponent', () => {
  let component: ModificarColadaComponent;
  let fixture: ComponentFixture<ModificarColadaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModificarColadaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModificarColadaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
