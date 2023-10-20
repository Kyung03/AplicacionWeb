import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EafModalComponent } from './eaf-modal.component';

describe('EafModalComponent', () => {
  let component: EafModalComponent;
  let fixture: ComponentFixture<EafModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EafModalComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EafModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
