import { TestBed } from '@angular/core/testing';

import { EafSerService } from './eaf-ser.service';

describe('EafSerService', () => {
  let service: EafSerService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EafSerService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
