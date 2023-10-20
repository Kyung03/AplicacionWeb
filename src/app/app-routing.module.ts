import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { EafReporteComponent } from './modulo/eaf-mod/eaf-mod.component';
import { AdmModComponent } from './modulo/adm-mod/adm-mod.component';
import { MccModComponent } from './modulo/mcc-mod/mcc-mod.component';
import { IngresarToneladasComponent } from './modulo/mcc-mod/ingresar-toneladas/ingresar-toneladas.component';
import { ModificarToneladasComponent } from './modulo/mcc-mod/modificar-toneladas/modificar-toneladas.component';
import { ReporteHornoComponent } from './modulo/eaf-mod/reporte-horno/reporte-horno.component';
import { ReporteTiemposComponent } from './modulo/eaf-mod/reporte-tiempos/reporte-tiempos.component';
import { ReporteCompletoComponent } from './modulo/eaf-mod/reporte-completo/reporte-completo.component';
import { ReporteGraficaComponent } from './modulo/eaf-mod/reporte-grafica/reporte-grafica.component';
import { RutaGuardGuard } from './guards/ruta-guard.guard';
import { IngresoGuardGuard } from './guards/ingreso-guard.guard';
import { RutaMccGuard } from './guards/ruta-mcc.guard';
import { RutaAdmGuard } from './guards/ruta-adm.guard';
import { SesionGuardGuard } from './guards/sesion-guard.guard';
import { PerfilAjusteComponent } from './modulo/perfil-ajuste/perfil-ajuste.component';
import { ModificarColadaComponent } from './modulo/adm-mod/modificar-colada/modificar-colada.component';
import { InicioAdmComponent } from './modulo/adm-mod/inicio-adm/inicio-adm.component';
import { TareaModComponent } from './modulo/plan-mod/tarea/tarea-mod/tarea-mod.component';
import { ColaboradorModComponent } from './modulo/plan-mod/colaborador/colaborador-mod/colaborador-mod.component';
import { CalendarioModComponent } from './modulo/plan-mod/calendario/calendario-mod/calendario-mod.component';


const routes: Routes = [
  //{ path: "", redirectTo: 'login', pathMatch: "full" },
  {
    path: "", component: AppComponent, canActivate: [SesionGuardGuard],
    //children: [{ path: "login", component: LoginComponent},{ path: "", component: LoginComponent}]
  },
  {
    path: "login", component: LoginComponent, canActivate: [IngresoGuardGuard]
  },
  {
    path: 'eaf', component: EafReporteComponent, canActivate: [RutaGuardGuard, SesionGuardGuard],
    children: [
      { path: '', component: ReporteHornoComponent },
      { path: 'horno', component: ReporteHornoComponent },
      { path: 'tiempos', component: ReporteTiemposComponent },
      { path: 'completo', component: ReporteCompletoComponent },
      { path: 'graficas', component: ReporteGraficaComponent },
      { path: 'perfil', component: PerfilAjusteComponent },
    ]
  },
  {
    path: "adm", component: AdmModComponent, canActivate: [RutaAdmGuard, SesionGuardGuard],
    children: [
      { path: '', component: InicioAdmComponent },
      { path: 'perfil', component: PerfilAjusteComponent },
      { path: 'horno', component: ReporteHornoComponent },
      { path: 'tiempos', component: ReporteTiemposComponent },
      { path: 'horno_datos', component: ReporteCompletoComponent },
      { path: 'horno_graficas', component: ReporteGraficaComponent },
      { path: 'mcc_mod', component: ModificarToneladasComponent },
      { path: 'eaf_mod', component: ModificarColadaComponent },
      { path: 'tarea_mod', component: TareaModComponent },
      { path: 'colab_mod', component: ColaboradorModComponent },
      { path: 'asig_mod', component: CalendarioModComponent },
    ]
  },
  {
    path: "mcc", component: MccModComponent, canActivate: [RutaMccGuard, SesionGuardGuard],
    children: [
      { path: '', component: IngresarToneladasComponent },
      { path: 'ingresar', component: IngresarToneladasComponent },
      { path: 'modificar', component: ModificarToneladasComponent },
      { path: 'perfil', component: PerfilAjusteComponent }
    ]
  }
];



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
