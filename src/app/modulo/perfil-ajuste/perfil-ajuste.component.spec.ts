import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PerfilAjusteComponent } from './perfil-ajuste.component';

describe('PerfilAjusteComponent', () => {
  let component: PerfilAjusteComponent;
  let fixture: ComponentFixture<PerfilAjusteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PerfilAjusteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PerfilAjusteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
