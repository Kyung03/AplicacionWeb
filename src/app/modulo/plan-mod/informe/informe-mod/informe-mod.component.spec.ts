import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InformeModComponent } from './informe-mod.component';

describe('InformeModComponent', () => {
  let component: InformeModComponent;
  let fixture: ComponentFixture<InformeModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ InformeModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InformeModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
