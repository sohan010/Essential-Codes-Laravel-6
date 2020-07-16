<!DOCTYPE html>
<html>
<head>
<title>Essential Backend Codes</title>

 <meta name="csrf-token" content="{{ csrf_token() }}">
 <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>

<!-- /*This is using fo tagsinput background changing*/ -->
<style>
.bootstrap-tagsinput .tag {
  background: black;
  border: 1px solid black;
  padding: 0 6px;
  margin-right: 2px;
  color: white;
  border-radius: 4px;
</style>


</head>
<body>
		<!-- Breadcrumb Sample -->
	  <div class="breadcrumbs mb-2">
      <div class="col-sm-4">
          <div class="page-header float-left">
              <div class="page-title">
                  <h1>Dashboard</h1>
              </div>
          </div>
      </div>
      <div class="col-sm-8">
          <div class="page-header float-right">
              <div class="page-title">
                  <ol class="breadcrumb text-right">
                      <li class="active">Product</li>
                      <li class="active">Create</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>


	<!-- Image Upload and show -->
  <div class="form-group col-md-6">
    <label class=" form-control-label">Image One</label>
    <div class="input-group">
      <input type="file" name="image_one" class="btn btn-dark upload" onchange="readURL1(this)">
        <img id="one" src="" alt="img">
    </div>
</div>


 <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
 <script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.all.min.js"></script>


<!-- This is for sweet alert global alert for delete -->
 <script>
   $(document).on("click", "#delete", function(e){
       e.preventDefault();
       var link = $(this).attr("href");
          swal({
            title: "Are you sure to Delete?",
            text: "Once Delete, You won't be able to revert this! ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                 window.location.href = link;
            } else {
              swal("Cancel!");
            }
          });
      });
    </script> 


<!-- This is for sweet alert2 alert for custom page delete -->
 <script type="text/javascript">
  function deleteProduct(id){
    Swal.fire({
     title: 'Are you sure?',
     text: "You won't be able to revert this!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
     if (result.value) {
       event.preventDefault();
       document.getElementById('delete-form-'+id).submit();
     }
    })
  }

</script>

 	<!-- For Selection Image View 1  -->
<script type="text/javascript">
 var $= jQuery.noConflict();
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#one')
                    .attr('src', e.target.result)
                    .width(60)
                    .height(60);
            };
            reader.readAsDataURL(input.files[0]);
        }
     }
  </script>


</body>
</html>