import { AppRoutingModule } from './app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from "@angular/forms"
import { AppComponent } from './app.component';
/** COMPONENTES */
import { LoginComponent } from './login/login.component';
import { BarraLateralComponent } from './barra/barra-lateral/barra-lateral.component';
import { BarraNavegacionComponent } from './barra/barra-navegacion/barra-navegacion.component';
import { PerfilAjusteComponent } from './modulo/perfil-ajuste/perfil-ajuste.component';
import { EafReporteComponent } from './modulo/eaf-mod/eaf-mod.component';
import { ReporteHornoComponent } from './modulo/eaf-mod/reporte-horno/reporte-horno.component';
import { ReporteTiemposComponent } from './modulo/eaf-mod/reporte-tiempos/reporte-tiempos.component';
import { ReporteCompletoComponent } from './modulo/eaf-mod/reporte-completo/reporte-completo.component';
import { ReporteGraficaComponent } from './modulo/eaf-mod/reporte-grafica/reporte-grafica.component';
import { MccModComponent } from './modulo/mcc-mod/mcc-mod.component';
import { IngresarToneladasComponent } from './modulo/mcc-mod/ingresar-toneladas/ingresar-toneladas.component';
import { ModificarToneladasComponent } from './modulo/mcc-mod/modificar-toneladas/modificar-toneladas.component';
import { AdmModComponent } from './modulo/adm-mod/adm-mod.component';
import { ModificarColadaComponent } from './modulo/adm-mod/modificar-colada/modificar-colada.component'; 
import { ModalComponent } from './modulo/modal/modal.component';
import { EafModalComponent } from './modulo/eaf-mod/eaf-modal/eaf-modal.component';
/** LIBRERIAS */
import { HttpClientModule } from '@angular/common/http';
import { CookieService } from 'ngx-cookie-service';
import { MatTableModule } from '@angular/material/table';
import { MatInputModule } from '@angular/material/input';
import { MatButtonModule } from '@angular/material/button';
import { MatSlideToggleModule } from '@angular/material/slide-toggle';
import { MatDialogModule } from '@angular/material/dialog';
import { MatPaginatorModule } from '@angular/material/paginator';
import { DragDropModule} from '@angular/cdk/drag-drop';
import { MatTabsModule } from '@angular/material/tabs';
import { MatGridListModule } from '@angular/material/grid-list';

/** COMPONENTES */
import { InicioAdmComponent } from './modulo/adm-mod/inicio-adm/inicio-adm.component';
import { GraficasComponent } from './modulo/graficas/graficas.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { TareaModComponent } from './modulo/plan-mod/tarea/tarea-mod/tarea-mod.component';
import { ColaboradorModComponent } from './modulo/plan-mod/colaborador/colaborador-mod/colaborador-mod.component';
import { CalendarioModComponent } from './modulo/plan-mod/calendario/calendario-mod/calendario-mod.component';
import { InformeModComponent } from './modulo/plan-mod/informe/informe-mod/informe-mod.component';

import { HashLocationStrategy, LocationStrategy } from '@angular/common';
@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    EafReporteComponent,
    MccModComponent,
    AdmModComponent,
    BarraLateralComponent,
    BarraNavegacionComponent,
    ReporteHornoComponent, 
    ReporteTiemposComponent, 
    ReporteCompletoComponent, 
    ReporteGraficaComponent, 
    IngresarToneladasComponent, 
    ModificarToneladasComponent, 
    PerfilAjusteComponent, 
    ModificarColadaComponent, 
    InicioAdmComponent, 
    GraficasComponent,
    ModalComponent, 
    EafModalComponent, 
    TareaModComponent, 
    ColaboradorModComponent, 
    CalendarioModComponent, 
    InformeModComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    MatTableModule,
    MatInputModule,
    MatButtonModule,
    MatDialogModule,
    MatSlideToggleModule,
    MatPaginatorModule,
    DragDropModule,
    MatTabsModule,
    MatGridListModule,
    BrowserAnimationsModule
  ],
  providers: [CookieService, MatTableModule,{ provide: LocationStrategy, useClass: HashLocationStrategy }],
  bootstrap: [AppComponent],
  schemas:[CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
