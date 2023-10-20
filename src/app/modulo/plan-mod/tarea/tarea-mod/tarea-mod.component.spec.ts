import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TareaModComponent } from './tarea-mod.component';

describe('TareaModComponent', () => {
  let component: TareaModComponent;
  let fixture: ComponentFixture<TareaModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TareaModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TareaModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
