import { TestBed } from '@angular/core/testing';

import { TareaServService } from './tarea-serv.service';

describe('TareaServService', () => {
  let service: TareaServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TareaServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
