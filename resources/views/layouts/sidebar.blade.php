 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title" key="t-menu">Menu</li>

                 <li>
                     <a href="{{ route('dashboard') }}" class="waves-effect">
                         <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                         <span key="t-dashboards">Dashboards</span>
                     </a>
                 </li>

                 <li class="menu-title" key="t-apps">Apps</li>

                 <li>
                     <a href="" class="waves-effect">
                         <i class="bx bx-user-circle"></i>
                         <span key="t-calendar">User</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('class.index') }}" class="waves-effect">
                         <i class="bx bx-receipt"></i>
                         <span key="t-invoice-list">Class</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('periode.index') }}" class="waves-effect">
                         <i class="bx bx-task"></i>
                         <span key="t-tasks">Periode</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('kandidat.index') }}" class="waves-effect">
                         <i class="bx bx-user-circle"></i>
                         <span key="t-authentication">Kandidat</span>
                     </a>
                 </li>
                 <li>
                     <a href="" class="waves-effect">
                         <i class="bx bx-calendar"></i>
                         <span key="t-calendar">Vote</span>
                     </a>
                 </li>

             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
 <!-- Left Sidebar End -->
