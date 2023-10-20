import { TestBed } from '@angular/core/testing';

import { CalendarioServService } from './calendario-serv.service';

describe('CalendarioServService', () => {
  let service: CalendarioServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CalendarioServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
