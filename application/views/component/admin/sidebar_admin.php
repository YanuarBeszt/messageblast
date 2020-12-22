 <?php $url = $this->uri->segment(1);
  $url2 = $this->uri->segment(2); ?>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="<?= base_url('Dashboard') ?>" class="brand-link">
     <span class="brand-text font-weight-light"><b>Admin</b>Marketing</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel d-flex" style="margin-top: 5%;">
       <div class="pull-left image" style="margin-top: 4%;">
         <img src="<?php echo base_url('assets/admin'); ?>/dist/img/default-avatar.png" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="pull-left info">
         <a href="#" class="d-block" style="color: #fff;"><?= $this->session->userdata('user_logged')->name; ?></a>
         <p style="color: #fff; font-size: 9pt;">
           <i class="fa fa-circle text-success"></i>
         </p>
       </div>
     </div>
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="<?= base_url("Dashboard") ?>" class="nav-link <?= $url === 'Dashboard' ? 'active' : '' ?>">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         <?php if ($this->session->userdata('user_logged')->id == 1) { ?>
           <li class="nav-item">
             <a href="<?= base_url("User") ?>" class="nav-link <?= $url === 'User' ? 'active' : '' ?>">
               <i class="nav-icon fas fa-user"></i>
               <p>
                 User
               </p>
             </a>
           </li>
         <?php } ?>
         <li class="nav-item">
           <a href="<?= base_url("Contact") ?>" class="nav-link <?= $url === 'Contact' ? 'active' : '' ?>">
             <i class="nav-icon fas fa-address-card"></i>
             <p>
               Contact
             </p>
           </a>
         </li>
         <li class="nav-item <?= $url === 'Email' ? 'menu-open' : '' ?>">
           <a href="" class="nav-link <?= $url === 'Email' ? 'active' : '' ?>">
             <i class="nav-icon fas fa-envelope"></i>
             <p>
               Email
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url("Email/draft") ?>" class="nav-link <?= $url === 'Email' && $url2 === 'draft' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>List draft</p>
               </a>
             </li>
             <!-- <li class="nav-item">
               <a href="<?= base_url("Email/blast") ?>" class="nav-link <?= $url === 'Email' && $url2 === 'blast' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Blast Email</p>
               </a>
             </li> -->
           </ul>
         </li>
         <li class="nav-item  <?= $url === 'Whatsapp' ? 'menu-open' : '' ?>">
           <a href="<?= base_url("Whatsapp") ?>" class="nav-link <?= $url === 'Whatsapp' ? 'active' : '' ?>">
             <i class="nav-icon fab fa-whatsapp"></i>
             <p>
               Whatsapp
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url("Whatsapp/draft") ?>" class="nav-link <?= $url === 'Whatsapp' && $url2 === 'draft' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>List draft</p>
               </a>
             </li>
             <!-- <li class="nav-item">
               <a href="<?= base_url("Whatsapp/blast") ?>" class="nav-link <?= $url === 'Whatsapp' && $url2 === 'blast' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Blast Whatsapp</p>
               </a>
             </li> -->
           </ul>
         </li>
         <li class="nav-item <?= $url === 'Message' ? 'menu-open' : '' ?>">
           <a href="<?= base_url("Message") ?>" class="nav-link <?= $url === 'Message' ? 'active' : '' ?>">
             <i class="nav-icon fas fa-sms"></i>
             <p>
               SMS
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url("Message/draft") ?>" class="nav-link <?= $url === 'Message' && $url2 === 'draft' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>List draft</p>
               </a>
             </li>
             <!-- <li class="nav-item">
               <a href="<?= base_url("Message/blast") ?>" class="nav-link <?= $url === 'Message' && $url2 === 'blast' ? 'active' : '' ?>">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Blast Whatsapp</p>
               </a>
             </li> -->
           </ul>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>