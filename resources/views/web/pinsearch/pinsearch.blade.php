@extends('web.templete.master')

@section('seo')
<meta name="description" content="Blazelog">
@endsection

@section('content')
<!--Page Header-->
<div class="page-header title-area">
    <div class="header-title">
       <div class="container">
          <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-title">Pin Code Search</h1>
             </div>
          </div>
       </div>
    </div>
    <div class="breadcrumb-area">
       <div class="container">
          <div class="row">
             <div class="col-md-8 col-sm-12 col-xs-12 site-breadcrumb">
                <nav class="breadcrumb">
                   <a class="home" href="{{route('web.index')}}"><span>Home</span></a>
                   <i class="fa fa-angle-right" aria-hidden="true"></i>
                   <span>Pin Code Search</span>
                </nav>
             </div>
          </div>
       </div>
    </div>
</div>
 <!--Page Header end-->
 <!--Partner with us -->
 <section class="tracksipment secpadd">
    <div class="container">
       <div class="row quote1top">
          <div class="col-md-8">
             <div class="fh-section-title clearfix f30  text-left version-dark paddbtm40">
                <h2>Pin Code Search</h2>
             </div>
             <div class="row paddtop30">
                <div class="col-sm-9">
                   <form method="POST" action="">
                      <div class="fh-form track-form">
                         <div>
                            <p class="field">
                               <input maxlength="6" placeholder="Enter Pincode*" id="pin" type="text">
                               <span style="
                               font-size: 15px;
                               font-weight: 600;" id="message"></span>
                            </p>
                            <p class="submit">
                              <input value="Check Available" onclick="checkPin()" id="submit_button" class="fh-btn" type="button">
                           </p>
                         </div>
                         
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--Partner with us end -->
@endsection

@section('script')
<script>
function checkPin(){
   let pin = $("#pin").val();
   console.log(pin);
   if (isNaN(pin)) 
   {
      $("#message").css('color', 'red').html('Invalid Input');
   }
   else{
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      }); 
      $.ajax({
         method: "POST",
         url:"{{ route('web.pincode.check') }}", 
         data: {
         "_token": "{{ csrf_token() }}",
               pin : pin,
         },
         success:function(response){ 
            if (response.status) {
               $("#message").css('color', 'green').html('Pin Code Available');
            }else{
               $("#message").css('color', 'red').html('Pin Code is Not Available');
            }
         }
      });
   }
}
</script>
@endsection
