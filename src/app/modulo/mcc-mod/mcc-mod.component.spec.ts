import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MccModComponent } from './mcc-mod.component';

describe('MccModComponent', () => {
  let component: MccModComponent;
  let fixture: ComponentFixture<MccModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MccModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MccModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
