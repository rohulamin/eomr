@extends('master')
@section('content')
  <!--Section: Contact v.2-->
<section class="mb-4" id="login-section">
  <h1 class="text-center font-weigh-bold" id="morningtune" style=" background-color: #eee;">Login with Good Morning</h1>
<script type="text/javascript">
  


    

</script>
   <form id="login" method="post" action="javascript:void(0)">
      @csrf
      <div id="errors-list"></div>

    <div class="column left-column">
        <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message" style="font-size:16px; text-transform: capitalize;"> </span>
      </div>
      <label for="eiin">User ID</label>
     <select class="inistitute form-control" id="instituts" name="email">
     <option>User ID</option>
</select>
 <span class="text-danger">{{ $errors->first('institutes') }}</span>


      <label for="subject_code">Password</label>
      <input type="password" name="password" id="password" placeholder="Password" class="form-control">

      <span class="text-danger">{{ $errors->first('passowrd') }}</span>

      @guest
       <button type="submit" id="send_form" class="btn btn-primary form-control">Login</button>
        <button type="submit" id="send_form" class="btn btn-primary form-control" onclick="goToRegistrartion()">Registration</button>
        @else
        <button type="submit" id="send_form" class="btn btn-primary form-control" onclick="goToHome()">Logout</button>
        @endguest

<script type="text/javascript">

// function getSubject(thisVal,e){
//     alert('hi');
// }








 // $(document).ready(function() {
        
 //      /*------------------------------------------
 //      --------------------------------------------
 //      Submit Event
 //      --------------------------------------------
 //      --------------------------------------------*/
 //      $(document).on("submit", "#handleAjax", function() {
 //          var e = this;
  
 //          $(this).find("[type='submit']").html("Login...");
 //  alert(e);
 //          $.ajax({
 //              url: "{{ route('login.post') }}",
 //              data: $(this).serialize(),
 //              type: "POST",
 //              dataType: 'json',
 //              success: function (data) {
  
 //                $(e).find("[type='submit']").html("Login");
  
 //                if (data.status) {
 //                    window.location = data.redirect;
 //                }else{
 //                    $(".alert").remove();
 //                    $.each(data.errors, function (key, val) {
 //                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
 //                    });
 //                }
               
 //              }
 //          });
  
 //          return false;
 //      });
  
 //    });


















function getWelcome(){

var dd = new Date();
    var hh = dd.getHours();

    if(hh >0){
      $('#morningtune').text("Login with Good Morning ");
       }else if(hh >11){
        $('#morningtune').text("Login with Good Afternoon ");

    }else if(hh > 20){
      $('#morningtune').text("Login with Good Evening ");

}else{
  $('#morningtune').text("Login with Good Night ");
 };

};




    $(document).ready(function() {


    
$('.inistitute').select2({
            placeholder: 'Search for a User',
            allowClear: true
        });

 $.ajax({
                  type: "get",
                  url: '{{url('getuser')}}',
                 
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    
    var transformedData = data.map(function(item) {
         return {
        value: item.email,
        text: item.name
      };
    });

  
    var selectElement = document.getElementById('instituts');

    // Generate HTML options using the transformed data and add them to the <select> element
    selectElement.innerHTML = transformedData.map(function(item) {
      return '<option onchange ="getsubject()"  value="' + item.value + '">' + item.value +'=> '+item.text+ '</option>';
    }).join('');
  }
 });
 
});
   
</script>

  
    </div>

    <div class="column font-weigh-bold" style="font-size: 16px;" >
      <img style="width: 300px;
       height: 200px;
       margin-top: 10px;
    float: left;
    vertical-align: top;" src="" id="logimg" width="300px;">
       
       
    </div>
  </form>

</section>


<script type="text/javascript">
    
$(document).ready(function () {

  
$('#login').on('submit', function(e){
              e.preventDefault();
              $.ajax({
                type: 'get',
                url: "{{url('post-login')}}",
                data: $('#login').serialize(),
                success: function(response){

                    console.log(response);
                    $(e).find("[type='submit']").html("Login");
  
                if (response.status) {
                    window.location = response.redirect;
                }else{
                    alert(response.errors);
                    $(".alert").remove();
                     $("#msg_div").append("<div class='alert alert-danger'>" + val + "</div>");
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
               
              }
                
            });
               return false;
        });


});   

// $('#etypeEntry').on('submit', function(e){
//             e.preventDefault();

     
//     // var center_code = $('#instituts').children("option:selected").val();
//     // var subject_code = $('#bima_no').val();
 

//      var data =  {
//       institutes: center_code,
//       subject_code:subject_code,
     

//       _token:  '{{ csrf_field() }}'
//     };
// alert($('#etypeEntry').serialize());
  
//   $.ajax({
//         url: "{{url('login.post')}}" ,
//         type: "get",
//        data: $('#etypeEntry').serialize(),
//         success: function( response ) {
                     
//         }
//       });

// });  
   

</script>
<!--Section: Contact v.2-->
@endsection

