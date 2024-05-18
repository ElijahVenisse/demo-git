@extends('layouts.app')
@section('content')
<div class="container">

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<!-- Header --> 
<div class="container-fluid header_se">
 <div class="col-md-8">
  <div class="row">
   <div class="col">
    <div id="reader"></div>
   </div>
   <div class="col" style="padding:30px;">
    <h4>SCAN RESULT</h4>
    <div id="result">Result Here</div>
   </div>
  </div>
 <script type="text/javascript">

  function onScanSuccess(data) {
    $.ajax({
      type: "POST",
      cache: false,
      url : "{{action('App\Http\Controllers\QrLoginController@checkUser')}}",
      data: {"_token": "{{ csrf_token() }}",data:data},
      success: function(data) {
          // after success to get Answer from controller if User Registered login user by scanner
          // and page change to Home blade
       if (data==1) {
        document.getElementById('result').innerHTML = '<span class="result">'+'Logged'+'</span>';
          $(location).attr('href', '{{url('/home')}}');
            }
       else{
        return confirm('There is no user with this qr code'); 
       }
      }
    })
  }
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess);
 </script>
 </div>
 </div>
</div>
<hr/>


<script type="text/javascript">
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
  });
</script>

<style>
  body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    background-image: linear-gradient(to right, #56CCF2, #F2C94C);
}
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }
        .row {
            display: flex;
        }
        #reader {
            background: black;
            width: 500px;
        }
        button, a#reader__dashboard_section_swaplink {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
        }
        span a {
            display: none;
        }
        #reader__camera_selection {
            background: blueviolet;
            color: aliceblue;
        }
        #reader__dashboard_section_csr span {
            color: red;
        }
    </style>
@yield('scripts')
@endsection