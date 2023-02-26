 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
     <div class="sidebar-brand-icon">
       <img src="{{asset('plantilla/img/logo/logo2.png')}}">
     </div>
     <div class="sidebar-brand-text mx-3">Control de Asistencias</div>
   </a>
   <hr class="sidebar-divider my-0">
   <li class="nav-item active">
     <a class="nav-link" href="{{route('home')}}">
       <i class="fas fa-fw fa-tachometer-alt"></i>
       <span>Dashboard</span></a>
   </li>
   <hr class="sidebar-divider">
   <div class="sidebar-heading">
     Control
   </div>
   <li class="nav-item">
     <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
       <i class="fas fa-users"></i>
       <span>Empleados</span>
     </a>
     <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <h6 class="collapse-header">Empleados</h6>
         <a class="collapse-item" href="/empleados">Empleados</a>
         <a class="collapse-item" href="/entradas">Entradas</a>
         <a class="collapse-item" href="/salidas">Salidas</a>
       </div>
     </div>
   </li>
   <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable2" aria-expanded="true" aria-controls="collapseTable">
       <i class="fas fa-money-bill"></i>
       <span>Pagos</span>
     </a>
     <div id="collapseTable2" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <h6 class="collapse-header">pagos</h6>
         <a class="collapse-item" href="/pagos">Pago empleado</a>
       </div>
     </div>
   </li>
   <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable3" aria-expanded="true" aria-controls="collapseTable">
       <i class="fas fa-print"></i>
       <span>Reportes</span>
     </a>
     <div id="collapseTable3" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <h6 class="collapse-header">Reporte</h6>
         <a class="collapse-item" href="/reporte">reporte</a>
       </div>
     </div>
   </li>



   <hr class="sidebar-divider">
   <div class="version" id="version-ruangadmin"></div>
 </ul>
 <!-- Sidebar -->