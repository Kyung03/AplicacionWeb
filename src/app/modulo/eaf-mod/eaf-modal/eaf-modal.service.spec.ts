import { TestBed } from '@angular/core/testing';

import { EafModalService } from './eaf-modal.service';

describe('EafModalService', () => {
  let service: EafModalService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EafModalService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
