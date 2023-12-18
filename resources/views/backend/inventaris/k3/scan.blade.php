@extends('layouts.backend.app')
@section('css')
    <style>
        /* #preview{
                       width:500px;
                       height: 500px;
                       margin:0px auto;
                    } */
    </style>
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')
    <div class="row">
        <div id="reader"></div>
        {{-- <video id="preview" width="25"></video> --}}
        {{-- <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
            <label class="btn btn-primary active">
                <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
            </label>
        </div> --}}
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    {{-- <script src="{{ URL::asset('public/assets/js/instascan.min.js') }}"></script> --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script> --}}
    {{-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
    <script type="text/javascript">
        // var scanner = new Instascan.Scanner({
        //     video: document.getElementById('preview'),
        //     scanPeriod: 5,
        //     mirror: false
        // });
        // scanner.addListener('scan', function(content) {
        //     // alert(content);
        //     window.location.href="{{ url('scans') }}"+'/'+content;
        //     //window.location.href=content;
        // });
        // Instascan.Camera.getCameras().then(function(cameras) {
        //     if (cameras.length > 0) {
        //         scanner.start(cameras[0]);
        //         $('[name="options"]').on('change', function() {
        //             if ($(this).val() == 1) {
        //                 if (cameras[0] != "") {
        //                     scanner.start(cameras[0]);
        //                 } else {
        //                     alert('No Front camera found!');
        //                 }
        //             } else if ($(this).val() == 2) {
        //                 if (cameras[1] != "") {
        //                     scanner.start(cameras[1]);
        //                 } else {
        //                     alert('No Back camera found!');
        //                 }
        //             }
        //         });
        //     } else {
        //         console.error('No cameras found.');
        //         alert('No cameras found.');
        //     }
        // }).catch(function(e) {
        //     console.error(e);
        //     alert(e);
        // });

        // const onScanSuccess = (decodedText, decodedResult) => {
        // // Handle on success condition with the decoded text or result.
        // // cek_qr(decodedText);

        // // if(decodedText){
        // //     window.location.href="{{ url('scans') }}"+'/'+decodedText;
        // // }
        // let timerInterval
        // Swal.fire({
        //     title: 'Auto close alert!',
        //     html: 'I will close in <b></b> milliseconds.',
        //     timer: 2000,
        //     timerProgressBar: true,
        //     didOpen: () => {
        //         Swal.showLoading()
        //         const b = Swal.getHtmlContainer().querySelector('b')
        //         timerInterval = setInterval(() => {
        //         b.textContent = Swal.getTimerLeft()
        //         }, 100)
        //     },
        //     willClose: () => {
        //         clearInterval(timerInterval)
        //     }
        //     }).then((result) => {
        //     /* Read more about handling dismissals below */
        //     if (result.dismiss === Swal.DismissReason.timer) {
        //         console.log('I was closed by the timer')
        //     }
        // })
        // }

        // const onScanFailure = (error) => {
        // let timerInterval
        // Swal.fire({
        //     title: 'Scan tidak terdeteksi',
        //     html: 'I will close in <b></b> milliseconds.',
        //     timer: 2000,
        //     timerProgressBar: true,
        //     didOpen: () => {
        //         Swal.showLoading()
        //         const b = Swal.getHtmlContainer().querySelector('b')
        //         timerInterval = setInterval(() => {
        //         b.textContent = Swal.getTimerLeft()
        //         }, 100)
        //     },
        //     willClose: () => {
        //         clearInterval(timerInterval)
        //     }
        //     }).then((result) => {
        //     /* Read more about handling dismissals below */
        //     if (result.dismiss === Swal.DismissReason.timer) {
        //         console.log('I was closed by the timer')
        //     }
        // })

        // console.log(`Scan result: ${decodedText}`, decodedResult);
        //     document.querySelector('#result').innerText = decodedText;
        //     if (currentText !== decodedText) {
        //         currentText = decodedText;
        //         beep(); 
        //     }
        // }

        // const html5QrcodeScanner = new Html5QrcodeScanner(
        //     "reader", { 
        //         fps: 10, 
        //         qrbox: 200,
        //         verbose:false,
        //         experimentalFeatures: {
        //             useBarCodeDetectorIfSupported: true
        //         },
        //         rememberLastUsedCamera: true,
        //         supportedScanTypes: [
        //             // Html5QrcodeScanType.SCAN_TYPE_FILE, 
        //             Html5QrcodeScanType.SCAN_TYPE_CAMERA
        //         ],
        //         showTorchButtonIfSupported: true
        //     });
        // html5QrcodeScanner.render(onScanSuccess);

        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {

        // console.log('Code matched = ${decodedText}', decodedResult);
        // document.getElementById("abs_name").value = decodedText;
        // window.location.href="{{ url('scans') }}"+'/'+decodedText;
        // html5QrcodeScanner.clear();
        // window.location.href="{{ url('scans') }}"+'/'+decodedText;
        // html5QrcodeScanner.clear().then((ignore) => {
        //     window.location.href="{{ url('scans') }}"+'/'+decodedText;
        // });
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                window.location.href="{{ url('scans') }}"+'/'+decodedText;
                // alert(`Scan result ${decodedText}`, decodedResult);
                // Handle on success condition with the decoded message.
                // console.log(`Scan result ${decodedText}`, decodedResult);
            }
        }

        // setTimeout(() => {
        //     let html5QrcodeScanner = new Html5QrcodeScanner(
        //         "reader",{ 
        //             fps: 10, 
        //             qrbox: { width: 250, height: 250 },
        //             experimentalFeatures: {
        //                 useBarCodeDetectorIfSupported: true
        //             },
        //             rememberLastUsedCamera: true,
        //             supportedScanTypes: [
        //                 // Html5QrcodeScanType.SCAN_TYPE_FILE, 
        //                 Html5QrcodeScanType.SCAN_TYPE_CAMERA
        //             ],
        //             showTorchButtonIfSupported: true
        //         },
        //     /* verbose= */ false);
    
        //     html5QrcodeScanner.render(onScanSuccess);
        // }, 1000);
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { 
                fps: 10, 
                qrbox: 250,
                experimentalFeatures: {
                    useBarCodeDetectorIfSupported: true
                },
                rememberLastUsedCamera: true,
                supportedScanTypes: [
                    // Html5QrcodeScanType.SCAN_TYPE_FILE, 
                    Html5QrcodeScanType.SCAN_TYPE_CAMERA
                ],
                showTorchButtonIfSupported: true
            });
        html5QrcodeScanner.render(onScanSuccess);


    </script>
@endsection
