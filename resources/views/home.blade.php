@extends('master')
@section('content')
  <!--Section: Contact v.2-->
<section class="mb-4" id="contentsec">
    <div class="row"> <div class="column-right"><h1 class="text-center font-weigh-bold" style=" background-color: #eee;">Center Wise OMR Bundle List</h1></div>
  <div class="column-right"><a class="btn btn-info rounded " style="border-radius: 5px;" onclick="goToDash()"> Go to Login</a></div></div>
      

    <div class="border border-primary" style="border: 3px solid #007646;
    border-radius: 15px;
    width: 100%;
    padding: 10px;
    font-size: 14px;
    background-color: #fff";> 
<form id="etypeEntry" method="post" action="javascript:void(0)">
      @csrf
       
      <label  for="eiin" style="padding:5px;">EIIN:</label>
     <select class="inistitute form-control" id="instituts" name="institutes" style="padding:5px;">
     <option>Search for a institutes</option>
</select>
 <span class="text-danger">{{ $errors->first('institutes') }}</span>


      <label for="subject_code" style="padding:5px;"> Subject</label>
      <select type="text"  id="subject_code" class="subject form-control" name="subject_code">
        <option>Search for a subject_code</option>
      </select>

      <span class="text-danger">{{ $errors->first('subject_code') }}</span>

      </form>

     
      
    </div>
<div class="table-responsive"  style="border: 1px solid #007646;
    border-radius: 15px;
    width: 100%;
    min-height: 400px;
    padding: 10px;
    font-size: 12px;
    background-color: #fff";>
     <table class="table table-bordered table-sm border-primary table-hover table-striped" width="100%" id="bodyData">
       <thead>
        <tr>
            <th>id</th>
            <th style="width:10px;">CENTER_CODE</th>
            <th>MADRASAH_NAME</th>
            <th>CENTER_EIIN</th>
            <th>ADDRESS</th>
              <th>SUBJECT_CODE</th>
             <th>BIMA_NO</th>
             <th>BIMA_DATE</th>
             <th>ENTRY_DATE</th>
             <th>ENTRY_OMR</th>
            <th> INSERTED_BY</th>
             <th>REST_OMR</th>
            
            
        </tr>
       </thead>
       <tbody >    
    
                @foreach ($users as $company)
                    <tr>
                       <td>{{ $company->id }}</td>
                        <td>{{ $company->CENTER_CODE }}</td>
                        <td>{{ $company->MADRASAH_NAME }}</td>
                        <td>{{ $company->CENTER_EIIN }}</td>
                        <td>{{ $company->THANA }},{{ $company->DISTRICT }}, {{ $company->PHONE }}</td>
                        <td>{{ $company->SUBJECT_CODE }}</td>
                          <td>{{ $company->BIMA_NO }}</td>
                        <td>{{ $company->BIMA_DATE }}</td>
                        <td>{{ $company->ENTRY_DATE }}</td>
                        <td>{{ $company->ENTRY_OMR }}</td>
                        <td>{{$company->INSERTED_BY}}</td>
                         <td>{{ $company->REST_OMR }}</td>
                    </tr>
                    @endforeach
            </tbody>
    </table>
  <div class=""> {{ $users->links('pagination::tailwind') }}, page no {{$users->currentPage()}}, Total OMR bundle:  {{$users->count()}} of {{$users->total()}},
</div>
    
</div>
  

</section>


<script type="text/javascript">

    $(document).ready(function() {

    //$('#instituts').empty(); 
    //$('#instituts option').remove();
 // $("#instituts").selectmenu('refresh', true);

        var global_eiin;
        var global_group_code;
        var global_madrasa_name;




 $.ajax({
                  type: "get",
                  url: '{{url('institutes')}}',
                 
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    // Parse the JSON response
    //var data = JSON.parse(response);
//$('#instituts').find('option').remove().end()
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

$('.inistitute').select2({
            placeholder: 'Search for a institutes',
            allowClear: true
        });

    
  }
 });

   //$('#instituts').empty();   
   
  var url = "{{url('subject')}}/"+global_eiin;



        $('.subject').select2({

            placeholder: 'Search for a Subject Code',
            allowClear: true,
            ajax: {
                url: url,
                dataType: 'json',
                processResults: function (data) {
                   
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.SUBJECT_CODE+'-'+item.SUBJECT_NAME,
                                id: item.SUBJECT_CODE
                                
                            }
                           
                        })
                    };
                }

            }
        });



   $('#instituts').change(function () {      
 
   
    
    
$('.subject').select2({
            placeholder: 'Search for a institutes',
            allowClear: true
        });


    var eiin =$(this).val();
  var url = "{{url('subject')}}/"+eiin;
 
$.ajax({
                  type: "get",
                  url: url,
                 
                   dataType: 'JSON',
                  encode: true,
      success: function(data) {
    // Parse the JSON response
    //var data = JSON.parse(response);
//$('#instituts').find('option').remove().end()
    // Use map() to iterate over the data and transform values
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


getData(eiin);
  
    
  
 });


     $('#subject_code').change(function () { 
    
    var subcode =$(this).val();
    var eiin = $('#instituts').children("option:selected").val();


subjectWise(eiin,subcode);


});



});

   

    

function getData(eiin) {
    
  // Send an AJAX request
  $.ajax({
    url: "{{url('center-wise-omr')}}/"+eiin,
    type: "GET",
    success: function(response) {
     $("#bodyData tbody").html(response);
    },
    error: function(xhr) {
      // On error, show an error message
      console.log(xhr.responseText);
    }
  });
}  


function subjectWise(eiin, subcode) {
  
 var data =  {
      subcode: subcode,
      eiin:eiin,
      _token:  '{{ csrf_field() }}'
    };

  // Send an AJAX request
  $.ajax({
    data:data,
    url: "{{url('subject-wise-omr')}}",
    type: "GET",
    success: function(response) {
     $("#bodyData tbody").html(response);
    },
    error: function(xhr) {
      // On error, show an error message
      console.log(xhr.responseText);
    }
  });
}  


</script>
<!--Section: Contact v.2-->
@endsection

