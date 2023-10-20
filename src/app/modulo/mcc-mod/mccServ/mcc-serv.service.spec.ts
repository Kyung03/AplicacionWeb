import { TestBed } from '@angular/core/testing';

import { MccServService } from './mcc-serv.service';

describe('MccServService', () => {
  let service: MccServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MccServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
