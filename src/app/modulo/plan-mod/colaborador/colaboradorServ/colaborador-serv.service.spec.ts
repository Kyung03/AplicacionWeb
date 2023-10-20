import { TestBed } from '@angular/core/testing';

import { ColaboradorServService } from './colaborador-serv.service';

describe('ColaboradorServService', () => {
  let service: ColaboradorServService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ColaboradorServService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
