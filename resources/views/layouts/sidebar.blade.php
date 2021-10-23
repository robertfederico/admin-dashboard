  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <img src="{{ asset('./images/vue.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Admin</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{ asset('./images/bootstrap.jpg') }}" class="img-circle elevation-2" alt="Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">{{ Auth::user()->name }}</a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
         <li class="nav-item">
           <router-link to="/home" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </router-link>
         </li>
         <li class="nav-item">
           <router-link to="/products" class="nav-link">
             <i class="nav-icon fas fa-shopping-cart"></i>
             <p>
               Products
             </p>
           </router-link>
         </li>
         <li class="nav-item">
           <router-link to="/create-product" class="nav-link">
             <i class="nav-icon fas fa-cart-plus"></i>
             <p>
               Create Product
             </p>
           </router-link>
         </li>

         <li class="nav-item">
           <router-link to="/videos" class="nav-link">
             <i class="nav-icon fas fa-video"></i>
             <p>
               Videos
             </p>
           </router-link>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>