import { TestBed } from '@angular/core/testing';

import { InformeServService } from './informe-serv.service';

describe('InformeServService', () => {
  let service: InformeServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(InformeServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
