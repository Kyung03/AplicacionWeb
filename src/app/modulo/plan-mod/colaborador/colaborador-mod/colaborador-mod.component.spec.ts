import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ColaboradorModComponent } from './colaborador-mod.component';

describe('ColaboradorModComponent', () => {
  let component: ColaboradorModComponent;
  let fixture: ComponentFixture<ColaboradorModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ColaboradorModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ColaboradorModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
