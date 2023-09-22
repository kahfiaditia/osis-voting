 <div class="vertical-menu">
     <div data-simplebar class="h-100">
         <div id="sidebar-menu">
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title" key="t-menu">Menu</li>
                 <li>
                     <a href="{{ route('dashboard') }}" class="waves-effect">
                         <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">SMAN
                             01</span>
                         <span key="t-dashboards">Dashboards</span>
                     </a>
                 </li>
                 <li class="menu-title" key="t-apps">Apps</li>
                 <li>
                     <a href="{{ route('pengguna.profil') }}" class="waves-effect">
                         <i class="bx bx-user-circle"></i>
                         <span key="t-calendar">Profil User</span>
                     </a>
                 </li>
                 @if (Auth::user()->roles == 'Administrator')
                     <li>
                         <a href="{{ route('pengguna.alluser') }}" class="waves-effect">
                             <i class="bx bx-list-ul"></i>
                             <span key="bx bx-list-ul">List User</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('pengguna.admin') }}" class="waves-effect">
                             <i class="bx bx-aperture"></i>
                             <span key="t-icons">Administrator</span>
                         </a>
                     </li>
                     {{-- <li>
                         <a href="{{ route('pengguna.data_guru') }}" class="waves-effect">
                             <i class="bx bx-task"></i>
                             <span key="t-task-list">Data Guru</span>
                         </a>
                     </li> --}}
                     <li>
                         <a href="{{ route('class.index') }}" class="waves-effect">
                             <i class="bx bx-receipt"></i>
                             <span key="t-invoice-list">Data Kelas</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('pengguna.index') }}" class="waves-effect">
                             <i class="bx bxs-user-detail"></i>
                             <span key="t-chat">Data Siswa</span>
                         </a>
                     </li>
                 @endif
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="bx bx-store"></i>
                         <span key="t-ecommerce">Evoting</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         @if (Auth::user()->roles == 'Administrator')
                             <li><a href="{{ route('periode.index') }}" key="t-products">Periode</a></li>
                             <li><a href="{{ route('kandidat.index') }}" key="t-product-detail">Kandidat</a></li>
                         @endif
                         <li><a href="{{ route('vote.index') }}" key="t-orders">Voting</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="bx bx-label"></i>
                         <span key="t-ecommerce">Ekstra Kulikuler</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('kegiatan.index') }}" key="t-products">Kegiatan</a></li>
                         <li><a href="{{ route('pembina.index') }}" key="t-products">Pembina</a></li>
                         <li><a href="{{ route('jadwal.index') }}" key="t-product-detail">Jadwal</a></li>
                         <li><a href="{{ route('follow.create') }}" key="t-orders">Ikuti</a></li>
                         <li><a href="{{ route('daftar_mandiri.index') }}" key="t-orders">Daftar Kegiatan</a>
                         </li>
                         <li><a class="inactive-link" key="t-orders">Absensi</a></li>
                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </div>
