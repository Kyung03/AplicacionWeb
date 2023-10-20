import { TestBed } from '@angular/core/testing';

import { RutaGuardGuard } from './ruta-guard.guard';

describe('RutaGuardGuard', () => {
  let guard: RutaGuardGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(RutaGuardGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
