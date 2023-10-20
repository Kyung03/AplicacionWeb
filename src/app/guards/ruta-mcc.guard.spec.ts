import { TestBed } from '@angular/core/testing';

import { RutaMccGuard } from './ruta-mcc.guard';

describe('RutaMccGuard', () => {
  let guard: RutaMccGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(RutaMccGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
