import { TestBed } from '@angular/core/testing';

import { RutaAdmGuard } from './ruta-adm.guard';

describe('RutaAdmGuard', () => {
  let guard: RutaAdmGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(RutaAdmGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
