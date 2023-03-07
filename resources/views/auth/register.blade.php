@extends('master')
@section('content')
  <!--Section: Contact v.2-->
<section class="mb-4" id="login-section">
  <h1 class="text-center font-weigh-bold" id="morningtune" style=" background-color: #eee;">Create A new Account</h1>

   <form id="etypeEntry" method="post" action="javascript:void(0)">
      @csrf

    <div class="column left-column">
   <div class="alert alert-success d-none" id="msg_div">
              <span> ekhane success message </span> 
        
      </div>
      <label for="eiin">User ID</label>
     <input type="text" name="email" class="form-control" placeholder="userid">
 <span class="text-danger">{{ $errors->first('institutes') }}</span>
   <label for="eiin">Full Name</label>
     <input type="text" name="name" class="form-control" placeholder="Full Name">
 <span class="text-danger">{{ $errors->first('institutes') }}</span>


      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Password" class="form-control">
      <span class="text-danger">{{ $errors->first('subject_code') }}</span>

      <label for="subject_code">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" placeholder="Password" class="form-control">
      <span class="text-danger">{{ $errors->first('subject_code') }}</span>
@guest
       <button type="submit" id="send_form" class="btn btn-primary form-control">Register</button>
       <button type="submit" id="" class="btn btn-primary form-control" onclick="goToLogin()">Login  </button>
       @else
        <button type="submit" id="" class="btn btn-primary form-control" onclick="goToHome()">Logout</button>
        @endguest
  
    </div>

    <div class="column font-weigh-bold" >
      <p id="res_message" style="font-size:16px; color:#FFF; text-transform: capitalize;"></p>
      <img style="width: 300px;
      margin-top: 30px;
      height: 220px;
    float: left;
    vertical-align: top;" src="" id="logimg" width="300px;">
     
       
    </div>
  </form>

</section>


<script type="text/javascript">
    
$(document).ready(function () {


$('#etypeEntry').on('submit', function(e){
            e.preventDefault();

 $('#send_form').html('Registeration Process Going------------------------>');            

  var data = $("#etypeEntry").serialize();
  // alert(data);
        
  $.ajax({
        url: "{{url('post-registration')}}" ,
        type: "get",
        data: data,
        success: function( response ) {
   $(e).find("[type='submit']").html("Register");
  
                if (response.status) {
                    window.location = response.redirect;
                }else{
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#msg_div").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
       
       }
      });
  return false;

});  
});   

</script>
<!--Section: Contact v.2-->
@endsection

