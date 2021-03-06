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
         <!-- Create -->
         <div class="row">
            <div class="col-lg-12">
               <h3 class="page-header">Create New Object</h3>

               <?php
               echo Form::open(array('action'=>'CephConsumer@create_object_receiver', 'files'=>true, 'method' => 'post'));
               echo '<div>';
               echo Form::text('bucket_name', null, array('class' => 'form-control', 'placeholder' => 'Bucket Name'));
               echo '<br>';
               echo Form::text('object_name', null, array('class' => 'form-control', 'placeholder' => 'Object Name'));
               echo '<br>';
               echo Form::file('object_content', '', array('id'=>'','class'=>''));
               echo '</div>';
               echo '<br>';
               echo Form::submit('Unggah', array('class'=>'btn btn-primary'));
               echo Form::close();
               ?>
               <!-- <form method="POST" action="/ceph/create_object_receiver" accept-charset="UTF-8">
                  <input name="_token" type="hidden" value="JZqK6etOd6LxTjfgBrxaZmGI02bE3aSkTEHrzQ9i">
                  <div>
                     <label for="bucket_name"></label>
                     <input class="form-control" name="bucket_name" type="text" id="bucket_name" placeholder="Bucket Name">
                     <label for="object_name"></label>
                     <input class="form-control" name="object_name" type="text" id="object_name" placeholder="Object Name">
                     <label for="object_content"></label>
                     <input class="form-control" name="object_content" type="file" id="object_content" placeholder="Content">
                  </div>
                  <br>
                  <input class="btn btn-primary" type="submit" value="Create">
               </form> -->
            </div>
         </div>
         <!-- Delete -->
         <div class="row">
            <div class="col-lg-12">
               <h3 class="page-header">Delete Object</h3>
               <form method="POST" action="/ceph/delete_object_receiver" accept-charset="UTF-8">
                  <input name="_token" type="hidden" value="JZqK6etOd6LxTjfgBrxaZmGI02bE3aSkTEHrzQ9i">
                  <div>
                     <label for="bucket_name"></label>
                     <input class="form-control" name="bucket_name" type="text" id="bucket_name" placeholder="Bucket Name">
                     <label for="object_name"></label>
                     <input class="form-control" name="object_name" type="text" id="object_name" placeholder="Object Name">
                  </div>
                  <br>
                  <input class="btn btn-danger" type="submit" value="Delete">
               </form>
            </div>
         </div>
         <!-- Copy -->
         <div class="row">
            <div class="col-lg-12">
               <h3 class="page-header">Copy Object</h3>
               <form method="POST" action="/ceph/copy_object_receiver" accept-charset="UTF-8">
                  <input name="_token" type="hidden" value="JZqK6etOd6LxTjfgBrxaZmGI02bE3aSkTEHrzQ9i">
                  <div>
                     <label for="source_bucket_name"></label> 
                     <input class="form-control" name="source_bucket_name" type="text" id="source_bucket_name" placeholder="Source Bucket Name">
                     <label for="source_object_name"></label>
                     <input class="form-control" name="source_object_name" type="text" id="source_object_name" placeholder="Source Object Name">
                     <label for="destination_bucket_name"></label>
                     <input class="form-control" name="destination_bucket_name" type="text" id="destination_bucket_name" placeholder="Destination Bucket Name">
                     <label for="destination_object_name"></label>
                     <input class="form-control" name="destination_object_name" type="text" id="destination_object_name" placeholder="Destination Object Name">
                  </div>
                  <br>
                  <input class="btn btn-warning" type="submit" value="Copy">
               </form>
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
