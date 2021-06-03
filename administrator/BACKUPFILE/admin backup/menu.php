     <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <a href="javascript:void(0)" class="brand-link">
         <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Administrator</span>
       </a>

       <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
           <div class="image">
             <img src="dist/img/<?php echo $TampilProfil['gambar'] ?>" class="img-circle elevation-2" alt="User Image">
           </div>
           <div class="info">
             <a href="#" class="d-block"><?php echo $TampilProfil['nama'] ?></a>
           </div>
         </div>

         <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item active">
               <a href="Dashboard.php" class="nav-link">
                 <i class="nav-icon fas fa-tachometer-alt"></i>
                 <p>
                   Dashboard
                 </p>
               </a>
             </li>

             <li class="nav-item has-treeview menu-open">
               <a href="#" class="nav-link active">
                 <i class="nav-icon fas fa-database"></i>
                 <p>
                   Master Data
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="DataGuru.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Data Accessor</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="DataSiswa.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Data Students</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="DataKelas.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Data Course</p>
                   </a>
                 </li>
               </ul>
             </li>
             <li class="nav-item has-treeview menu-close">
               <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-cog"></i>
                 <p>
                   Konfigurasi
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="SetApp.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Setting Aplikasi</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="SetDocs.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Setting Dokumen</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="SetAdmin.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Setting Akun</p>
                   </a>
                 </li>
               </ul>
             </li>

             <li class="nav-item has-treeview menu-close">
               <a href="#" class="nav-link">
                 <i class="fas fa-server nav-icon"></i>
                 <p>
                   Database
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="Restart.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Restart Database</p>
                   </a>
                 </li>
               </ul>
             </li>

             <li class="nav-item has-treeview menu-close">
               <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-envelope-open-text"></i>
                 <p>
                   Messange
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="PesanGuru.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Pesan Accessor</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="PesanSiswa.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Pesan Students</p>
                   </a>
                 </li>
               </ul>
             </li>
             <li class="nav-item">
               <a href="./php/logout.php" class="nav-link">
                 <ion-icon name="exit-outline" class="nav-icon"></ion-icon>
                 <p>
                   Log Out
                 </p>
               </a>
             </li>
           </ul>
         </nav>
       </div>
     </aside>