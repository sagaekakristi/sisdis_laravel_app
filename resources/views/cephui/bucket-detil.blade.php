<!DOCTYPE html>
<!-- Template by Quackit.com -->
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Ceph</title>
      <!-- Bootstrap Core CSS -->
      <link href="{{ asset('assets/ceph/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
      <link href="{{ asset('assets/ceph/css/custom.css') }}" rel="stylesheet">
      <style type="text/css">
         body {
         font-family: Verdana;
         }
      </style>
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #2C3E50;">
         <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/cephui/">
               Kelompok 1
               </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
               <ul class="nav navbar-nav">
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bucket<span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a href="/cephui/">List</a></li>
                        <li><a href="/cephui/bucket">Create/Delete</a></li>
                     </ul>
                  </li>
                  <li><a href="/cephui/object">Object</a></li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>
      <!-- Content -->
      <div class="container">
         <!-- Bucket -->
         <div class="row">
            <div class="col-lg-12">
               <h3 class="page-header">Nama Bucket
                  <small>List of Object</small>
               </h3>
               <ul>
                  <?php
                  foreach($list_of_object as $object_name){
                     echo '<li>';
                     $url = url('ceph/' . $bucket_name . '/' . $object_name);
                     echo '<a href="' . $url . '">' . $object_name . '</a>' . '<br>';
                     echo '<br>';
                     echo '</li>';
                  }
                  ?>
               </ul>
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- jQuery -->
      <script src="{{ asset('assets/ceph/js/jquery-1.11.3.min.js') }}"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="{{ asset('assets/ceph/js/bootstrap.min.js') }}"></script>
      <!-- IE10 viewport bug workaround -->
      <script src="{{ asset('assets/ceph/js/ie10-viewport-bug-workaround.js') }}"></script>
      <!-- Placeholder Images -->
      <script src="{{ asset('assets/ceph/js/holder.min.js') }}"></script>
      <div style="height: 40px;"></div>
   </body>
</html>
