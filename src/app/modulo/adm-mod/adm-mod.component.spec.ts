import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdmModComponent } from './adm-mod.component';

describe('AdmModComponent', () => {
  let component: AdmModComponent;
  let fixture: ComponentFixture<AdmModComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdmModComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AdmModComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
