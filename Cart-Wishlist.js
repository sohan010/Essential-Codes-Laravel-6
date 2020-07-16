
Cart Add Jquery Ajax Code

    $(document).ready(function() {
          $('.AddToCart').on('click', function(){
            var id = $(this).data('id');

            if(id) {
               $.ajax({
                   url: "{{  url('/add/to/cart/') }}/"+id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                     const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
                     }

                   },

               });
           } else {
               alert('danger');
           }
            e.preventDefault();
       });
   });




   Wishlist Add Jquery Ajax Code

      $(document).ready(function() {
            $('.AddToWishlist').on('click', function(){
              var id = $(this).data('id');

              if(id) {
                 $.ajax({
                     url: "{{  url('/add/to/wishlist/') }}/"+id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                       const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        })

                       if($.isEmptyObject(data.error)){
                            Toast.fire({
                              type: 'success',
                              title: data.success
                            })
                       }else{
                             Toast.fire({
                                type: 'error',
                                title: data.error
                            })
                       }

                     },

                 });
             } else {
                 alert('danger');
             }
              e.preventDefault();
         });
     });
