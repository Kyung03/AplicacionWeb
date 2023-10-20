import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CalendarioModComponent } from './calendario-mod.component';

describe('CalendarioModComponent', () => {
  let component: CalendarioModComponent;
  let fixture: ComponentFixture<CalendarioModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CalendarioModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CalendarioModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
