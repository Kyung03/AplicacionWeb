import { TestBed } from '@angular/core/testing';

import { AdmServService } from './adm-serv.service';

describe('AdmServService', () => {
  let service: AdmServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AdmServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
