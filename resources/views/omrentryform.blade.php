@extends('master')
@section('content')
  <!--Section: Contact v.2-->
<section class="mb-4" id="contentsec">
  <h1 class="text-center font-weigh-bold" style=" background-color: #eee;">E-type OMR Entry Form</h1>
<div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    <h3>Wellcome <b style="color:green;"> {{auth()->user()->name}} </b> You are Logged In!</h3>
                </div>
   <form id="etypeEntry" method="post" action="javascript:void(0)">
      @csrf

    <div class="column left-column">
        <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message" style="font-size:16px; text-transform: capitalize;"></span>
      </div>
      <label for="eiin">Center Code:</label>
     <select class="inistitute form-control" id="instituts" name="institutes" >
     <option>Search for a institutes</option>
</select>
 <span class="text-danger">{{ $errors->first('institutes') }}</span>


      <label for="subject_code"> Subject Code:</label>
      <select type="text" id="subject_code" class="subject form-control" name="subject_code">
        <option>Search for a subject_code</option>
      </select>

      <span class="text-danger">{{ $errors->first('subject_code') }}</span>




      <label for="bima_no">Bima No:</label>
      <input type="text" id="bima_no" name="bima_no" required>
       <span class="text-danger">{{ $errors->first('bima_no') }}</span>

      <label for="bima_date">Bima Date:</label>
      <input type="date" id="bima_date" name="bima_date" required>
       <span class="text-danger">{{ $errors->first('bima_date') }}</span>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" required>
       <span class="text-danger">{{ $errors->first('quantity') }}</span>
         
       <button type="submit" id="send_form" class="btn btn-info">Submit</button>
       <a href="{{url('home')}}" class="btn btn-info">Home</a>

    </div>

    <div class="column font-weigh-bold" style="font-size: 16px; text-transform: uppercase; text-align: left;" >
        <table class="table table-hover " >
            <tr ><th>Date:</th><td id="curdate" style="padding-left: 20px;"><?php echo date("Y-m-d");?></td></tr>
            <tr ><th>Total OMR :</th><td style="padding-left: 20px;" id="total_Omr"></td></tr>
            <tr ><th>Received OMR:</th><td style="padding-left: 20px;" id="receivomr"></td></tr>
            <tr ><th>Rest OMR:</th><td style="padding-left: 20px;" id="nonreceivomr"></td></tr>
           <!--  <tr ><th>CENTER_CODE:</th><td style="padding-left: 20px;" id="center_code"></td></tr> -->
            <tr ><th>CENTER_NAME:</th><td style="padding-left: 20px;" id="center_name"></td></tr>
            <tr ><th>GROUP:</th><td style="padding-left: 20px;" id="group_name"></td></tr> 
            <tr ><th>Subject:</th><td style="padding-left: 20px;" id="subject_name"></td></tr> 
            <tr ><th>CENTER_EIIN:</th><td style="padding-left: 20px;" id="center_eiin"></td></tr>
            <tr style="height: 10px" ><th>District:</th><td style="padding-left: 20px;" id="district"></td></tr>
            <tr style="height: 10px" ><th>Thana:</th><td style="padding-left: 20px;" id="thana"></td></tr>
            <tr style="height: 10px" ><th>Contact:</th><td style="padding-left: 20px;" id="phone"></td></tr>
                
            

        </table>
       
    </div>
  </form>

</section>



<script type="text/javascript">

// function getSubject(thisVal,e){
//     alert('hi');
// }


$('.subject').select2({
            placeholder: 'Search for a institutes',
            allowClear: true
        });


function getInstitutesList(){

      

$('.inistitute').select2({
            placeholder: 'Search for a institutes',
            allowClear: true
        });

 $.ajax({
                  type: "get",
                  url: '{{url('institutes')}}',
                 
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    // Parse the JSON response
    //var data = JSON.parse(response);
// $('#instituts').find('option').remove().end()
    // Use map() to iterate over the data and transform values
    var transformedData = data.map(function(item) {
      // Do some transformations on the item
      return {
        value: item.CENTER_CODE,
        text: item.MADRASAH_NAME
      };
    });

    // Get the <select> element
    var selectElement = document.getElementById('instituts');

    // Generate HTML options using the transformed data and add them to the <select> element
    selectElement.innerHTML = transformedData.map(function(item) {
      return '<option onchange ="getsubject()"  value="' + item.value + '">' + item.value +' '+item.text+ '</option>';
    }).join('');
  }
 });



}

function getSubjectList(){


    $('#instituts').change(function () {

    
    var center_code =$(this).val();
// alert(center_code);
  var url = "{{url('subject')}}/"+center_code;
 var data ={
      center_code: center_code,
     _token:  '{{ csrf_field() }}'
    };
$.ajax({
                  type: "get",
                  url: url,
                 
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    var transformedData = data.map(function(item) {
      // Do some transformations on the item
      return {
        value: item.SUBJECT_CODE,
        text: item.SUBJECT_NAME
      };
    });

    // Get the <select> element
    var selectElement = document.getElementById('subject_code');

    // Generate HTML options using the transformed data and add them to the <select> element
    selectElement.innerHTML = transformedData.map(function(item) {
      return '<option onchange ="getsubject()"  value="' + item.value + '">' + item.value +' '+item.text+ '</option>';
    }).join('');
  }
 });

 $('#center_eiin').empty();
   $('#district').empty();
    $('#thana').empty();
    $('#phone').empty();
     $('#total_Omr').empty();
    $('#center_name').empty();
     $('#center_code').empty();
    $('#group_name').empty();
    $('#subject_name').empty();
    $('#total_student').empty();
    $('#receivomr').empty();
    $('#nonreceivomr').empty();

});
}


    $(document).ready(function() {
        
getInstitutesList();
 
getSubjectList();
   


     $('#subject_code').change(function () { 
    
    var subcode =$(this).val();
    var eiin = $('#instituts').children("option:selected").val();
    // alert(subcode+eiin);
     var data =  {
      subcode: subcode,
      eiin:eiin,
      _token:  '{{ csrf_field() }}'
    };
  var url = "{{url('institutesinfo')}}/";

 $.ajax({
                  type: "get",
                  url: url,
                 data:data,
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    $("#center_code").text(data[0].CENTER_CODE);
    $("#center_name").text(data[0].CENTER_CODE+"-"+data[0].MADRASAH_NAME);
    $("#center_eiin").text(data[0].CENTER_EIIN);
    $("#district").text(data[0].DISTRICT);
    $("#thana").text(data[0].THANA);
    $("#phone").text(data[0].PHONE);
    $("#group_name").text(data[0].GROUP_NAME);
    $("#subject_name").text(data[0].SUBJECT_CODE+"=>"+data[0].SUBJECT_NAME);
var total_std = data[0].TOTAL_STUDENTS+data[1].TOTAL_STUDENTS+data[2].TOTAL_STUDENTS;
var totalomr =total_std;
// alert("Total Student-"+total_std);
$("#total_Omr").text(total_std);
// total_std = $("#total_Omr").text();
//alert(total_std);


var subcode =$('#subject_code').children("option:selected").val();
    var eiin = $('#instituts').children("option:selected").val();
    // alert(subcode+eiin);
     var data =  {
      subcode: subcode,
      eiin:eiin,
      _token:  '{{ csrf_field() }}'
    };
  
 $.ajax({
                  type: "get",
                  url: "{{url('receivedomr')}}/",
                 data:data,
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
        // alert(data[0].SUBJECT_NAME);
    // Parse the JSON response
    // var data = JSON.parse(data);
        // alert(data.success);
 var omr = $('#total_Omr').text(total_std);
// alert(data.success);
 if(data.success==0){
    // alert(data.success);
    $("#nonreceivomr").text(totalomr);
    $("#receivomr").text(data.success);
 }
 else{
      // alert(totalomr);
   $("#nonreceivomr").text(totalomr-data.success);
   $("#receivomr").text(data.success); 
 }
 // alert(totalomr);




console.log("SUCCESS : ", data.success);
// $('#madrasa_info').(data);




      }

  });



      }

  });






})



});


   

$(document).ready(function () {

// $('#etypeEntry').on('submit', function(e){
//             e.preventDefault();
//             $.ajax({
//                 type: 'POST',
//                 url: "{{url('etype-data')}}",
//                 data: $('#etypeEntry').serialize(),
//                 success: function(response){
//                     console.log(response);
//                 }
//             });
//         });


// });   

$('#etypeEntry').on('submit', function(e){
            e.preventDefault();


             $('#res_message').hide();
            $('#msg_div').hide();

            var CENTER_EIIN =$('#center_eiin').text();


 $('#send_form').html('Submit----------------------------->');
   


  var bimano =$('#bima_no').val();
   var bimadate =$('#bima_date').val();
    var qty =$('#quantity').val();
    var center_code = $('#instituts').children("option:selected").val();
    var subject_code = $('#subject_code').children("option:selected").val();
    var CENTER_EIIN =$('#center_eiin').text();
    var DISTRICT =$('#district').text();
    var THANA =$('#thana').text();
    var PHONE =$('#phone').text();
    var ENTRY_DATE =$('#curdate').text();
    var REST_OMR =$('#nonreceivomr').text()-qty;
//     if($('#nonreceivomr').text()==0){
// var REST_OMR =$('#total_Omr').text()-qty;
//     }else{
//      var REST_OMR =$('#nonreceivomr').text()-qty;   
//     }
     var MADRASAH_NAME =$('#center_name').text().substring(4);
     // alert(MADRASAH_NAME);



     var data =  {
      institutes: center_code,
      subject_code:subject_code,
       bima_no: bimano,
      bima_date:bimadate,
       CENTER_EIIN:CENTER_EIIN,
       quantity:qty,
       DISTRICT:DISTRICT,
       THANA:THANA,
       PHONE:PHONE,
       ENTRY_DATE:ENTRY_DATE,
       REST_OMR:REST_OMR,
       MADRASAH_NAME:MADRASAH_NAME,

      _token:  '{{ csrf_field() }}'
    };

  
  $.ajax({
        url: "{{url('save-form')}}" ,
        type: "get",
        data: data,
        success: function( response ) {
            $('#send_form').html('Submit');
            $('#msg_div').show()
            $('#res_message').show();
            $('#res_message').html(response.success);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("etypeEntry").reset();
 // $('#instituts option').removeAttr("selected");
 //  $('#subject_code option').removeAttr("selected");

      $('#instituts').empty();
          $('#subject_code').empty();
   //  $('#center_eiin').empty();
   // $('#district').empty();
   //  $('#thana').empty();
   //  $('#phone').empty();
   //   $('#total_Omr').empty();
   //  $('#center_name').empty();
   //   $('#center_code').empty();
   //  $('#group_name').empty();
   //  $('#subject_name').empty();
   //  $('#total_student').empty();
    getInstitutesList();
    

            setTimeout(function(){
            // $('#res_message').hide();
            // $('#msg_div').hide();
            },100);
        }
      });

});  
});   

</script>
<!--Section: Contact v.2-->
@endsection

