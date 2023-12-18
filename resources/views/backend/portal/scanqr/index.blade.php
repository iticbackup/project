<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Scan QR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css">
    <style>
        input[type="radio"] {
            visibility: hidden;
        }

        body {
            background-color: 'black'
        }

        .html5-qrcode-element {
            width: 130px;
            height: 40px;
            color: #f0094a;
            border-radius: 5px;
            border-color: #f0094a;
            /* padding: 10px 25px; */
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            font-size: 9pt;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
                7px 7px 20px 0px rgba(0, 0, 0, .1),
                4px 4px 5px 0px rgba(0, 0, 0, .1);
            outline: none;
        }

        .html5-qrcode-element:hover {
            color: #f0094a;
            background: transparent;
            box-shadow: none;
        }

        .html5-qrcode-element:before,
        .html5-qrcode-element:after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            height: 2px;
            width: 0;
            background: #f0094a;
            box-shadow:
                -1px -1px 5px 0px #fff,
                7px 7px 20px 0px #0003,
                4px 4px 5px 0px #0002;
            transition: 400ms ease all;
        }

        .html5-qrcode-element:after {
            right: inherit;
            top: inherit;
            left: 0;
            bottom: 0;
        }

        .html5-qrcode-element:hover:before,
        .html5-qrcode-element:hover:after {
            width: 100%;
            transition: 800ms ease all;
        }

        .layout-qr {
            border: 2.5px solid #D61355;
        }
    </style>
</head>

<body>
    @include('backend.portal.scanqr.modalCheckQr')
    @include('backend.portal.scanqr.modalCheckQrIT')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center" style="vertical-align: middle">
                <div class="card">
                    <div class="layout-qr">
                        <div id="reader"></div>
                    </div>
                    <div id="qr-reader-results"></div>
                    {{-- <video id="preview" class="card-img-top"></video> --}}
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">Scan QR Code</h5>
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p> --}}
                    </div>
                    {{-- <div class="card-body">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="options" value="1" autocomplete="off">Front Camera
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" value="2" autocomplete="off" checked>Back
                                Camera
                            </label>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    {{-- <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script> --}}
    {{-- <script src="{{ URL::asset('public/assets/js/instascan.min.js') }}"></script> --}}
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    <script src="{{ URL::asset('public/assets/js/html5-qrcode.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        // var scanner = new Instascan.Scanner({
        //     video: document.getElementById('preview'),
        //     scanPeriod: 5,
        //     mirror: false
        // });

        function setInputData(id) {
            // window.alert(window.location.href += "?id=" + id);
            alert(id);
        }
        // function cek_image_apar(id){
        //     Swal.fire({
        //         title: 'Sweet!',
        //         text: 'Modal with a custom image.',
        //         imageUrl: id,
        //         imageWidth: 400,
        //         imageHeight: 200,
        //         imageAlt: 'Custom image',
        //     })
        // }
        function cek_qr(id) {
            $.ajax({
                type: 'GET',
                // url: "{{ url('scanqr') }}" + '/' + content,
                url: "{{ url('scanqr') }}" + '/' + id,
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        // alert(result.data_1);
                        // setInputData(result.data_1.kode_barcode);
                        var url = "{{ url('scans') }}" + '/' + id;
                        document.getElementById('setInputData').innerHTML = '<a href="' + url +
                            '" class="btn btn-success">' + '<i class="fa fa-plus""></i> Input Data' + '</a>';
                        document.getElementById('scan_kode').innerHTML = result.data_1.kode_barcode;
                        document.getElementById('scan_lokasi').innerHTML = result.data_1.lokasi;
                        const dataK3 = result.data_2.detail;
                        var k3 = "";

                        dataK3.forEach(data_k3);

                        function data_k3(value, index) {
                            if (value.jenis_barang == "APAR") {
                                // const title = document.getElementsByClassName('detailScanTitle');
                                // title[0].innerHTML = "Data Detail APAR";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<th class='text-center' colspan='3'>" + "Data Detail APAR" + "</th>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<td>" + "Jenis Barang" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.jenis_barang + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<td>" + "Kode Tabung" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.kode_tabung + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Jenis" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.jenis + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Warna" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.warna + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Berat" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.berat + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Lokasi" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.lokasi + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<th class='text-center' colspan='3'>" + "Detail Pengecekan APAR" +
                                    "</th>";
                                k3 = k3 + "</tr>";

                                const dataK3PengecekanApar = value.detail_pengecekan;
                                var detailPengecekanApar = "";
                                dataK3PengecekanApar.forEach(data_detail_pengecekan_k3);

                                function data_detail_pengecekan_k3(value, index) {
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar +
                                        "<td colspan='3' class='text-center' style='background-color:green;color:white;font-weight:bold'>" +
                                        "Bulan " + value.bulan + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Tanggal" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        value.tanggal + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Pressure" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.pressure == "Y") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-check' style='color: green'></i>" + "</td>";
                                    } else if (value.pressure == "T") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-times' style='color: red'></i>" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Nozzel" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.nozzel == "Y") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-check' style='color: green'></i>" + "</td>";
                                    } else if (value.nozzel == "T") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-times' style='color: red'></i>" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Segel" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.segel == "Y") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-check' style='color: green'></i>" + "</td>";
                                    } else if (value.segel == "T") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-times' style='color: red'></i>" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Tuas" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.tuas == "Y") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-check' style='color: green'></i>" + "</td>";
                                    } else if (value.tuas == "T") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<i class='fa fa-times' style='color: red'></i>" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Keterangan" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.keterangan == null || value.keterangan == '-') {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + value.keterangan + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Petugas" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.petugas == null || value.petugas == '-') {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + value.petugas + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Bukti Foto" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.image_apar == null || value.image_apar == '-') {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "<a href='" + value.image_apar +
                                            "' target='_blank'><img src='" + value.image_apar +
                                            "' width='100' ></a>" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<tr>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        "Status" + "</td>";
                                    detailPengecekanApar = detailPengecekanApar + "<td class='text-center'>" +
                                        ":" + "</td>";
                                    if (value.status == "Y") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<span class='badge text-bg-success'>Verifikasi diterima</span>" +
                                            "</td>";
                                    } else if (value.status == "T") {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<span class='badge text-bg-danger'>Verifikasi ditolak</span>" +
                                            "</td>";
                                    } else if (value.status == 0) {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" +
                                            "<span class='badge text-bg-warning'>Menunggu Persetujuan</span>" +
                                            "</td>";
                                    } else {
                                        detailPengecekanApar = detailPengecekanApar +
                                            "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    detailPengecekanApar = detailPengecekanApar + "</tr>";
                                }
                                k3 = k3 + detailPengecekanApar;
                            } else if (value.jenis_barang == "HYDRANT") {
                                // const title = document.getElementsByClassName('detailScanTitle');
                                // title[0].innerHTML = "Data Detail HYDRANT";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<th class='text-center' colspan='3'>" + "Data Detail HYDRANT" +
                                    "</th>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<td>" + "Jenis Barang" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.jenis_barang + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Lokasi" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.lokasi + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<td>" + "Periode" + "</td>";
                                k3 = k3 + "<td>" + ":" + "</td>";
                                k3 = k3 + "<td>" + value.periode + "</td>";
                                k3 = k3 + "</tr>";
                                k3 = k3 + "<tr>";
                                k3 = k3 + "<th class='text-center' colspan='3'>" + "Detail Pengecekan HYDRANT" +
                                    "</th>";
                                k3 = k3 + "</tr>";

                                const dataK3PengecekanHydrant = value.detail_pengecekan;
                                var hydrant = "";
                                dataK3PengecekanHydrant.forEach(data_detail_pengecekan_k3_hydrant);

                                function data_detail_pengecekan_k3_hydrant(value, index) {
                                    // alert(value.selang['besar']);
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant +
                                        "<td colspan='3' class='text-center' style='background-color:green;color:white;font-weight:bold'>" +
                                        "Bulan " + value.bulan + "</td>";
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Tanggal" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + value.tanggal + "</td>";
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Selang" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.selang[0] != null) {
                                        if (value.selang[0]['besar'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Besar : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                        if (value.selang[0]['kecil'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Kecil : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Kran" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.kran[0] != null) {
                                        if (value.kran[0]['besar'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Besar : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                        if (value.kran[0]['kecil'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Kecil : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Nozzel" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.nozzel[0] != null) {
                                        if (value.nozzel[0]['besar'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Besar : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                        if (value.nozzel[0]['kecil'] == "Y") {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div>Kecil : <i class='fa fa-check' style='color: green'></i></div>" +
                                                "</td>";
                                        } else {
                                            hydrant = hydrant + "<td class='text-center'>" +
                                                "<div><i class='fa fa-times' style='color: red'></i></div>" +
                                                "</td>";
                                        }
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Keterangan" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.keterangan == null || value.keterangan == '-') {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + value.keterangan +
                                            "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Petugas" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.petugas == null || value.petugas == '-') {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + value.petugas +
                                            "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Bukti Foto" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.image_hydrant == null || value.image_hydrant == '-') {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'><a href='" + value
                                            .image_hydrant + "' target='_blank'><img src='" + value
                                            .image_hydrant + "' width='100' ></td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                    hydrant = hydrant + "<tr>";
                                    hydrant = hydrant + "<td class='text-center'>" + "Status" + "</td>";
                                    hydrant = hydrant + "<td class='text-center'>" + ":" + "</td>";
                                    if (value.status == "Y") {
                                        hydrant = hydrant + "<td class='text-center'>" +
                                            "<span class='badge text-bg-success'>Verifikasi diterima</span>" +
                                            "</td>";
                                    } else if (value.status == "T") {
                                        hydrant = hydrant + "<td class='text-center'>" +
                                            "<span class='badge text-bg-danger'>Verifikasi ditolak</span>" +
                                            "</td>";
                                    } else if (value.status == 0) {
                                        hydrant = hydrant + "<td class='text-center'>" +
                                            "<span class='badge text-bg-warning'>Menunggu Persetujuan</span>" +
                                            "</td>";
                                    } else {
                                        hydrant = hydrant + "<td class='text-center'>" + "-" + "</td>";
                                    }
                                    hydrant = hydrant + "</tr>";
                                }
                                k3 = k3 + hydrant;
                            }
                        }

                        document.getElementById('data-detail').innerHTML = k3;
                        $('.scanCheck').modal('show');
                    } else if (result.success == false) {
                        // alert(result.message);
                        cek_qr_it_asset(id);
                    }
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }
        // cek_qr('AH124');
        function cek_qr_it_asset(id) {
            $.ajax({
                type: 'GET',
                // url: "{{ url('scanqr') }}" + '/' + content,
                url: "{{ url('scanqrITAsset') }}" + '/' + id,
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        if (result.data_1 != null || result.data_2 != null) {
                            if (result.data_2 != null) {
                                document.getElementById('scan_kode_it').innerHTML = result.data_1.nama_label;
                                document.getElementById('scan_lokasi_it').innerHTML = result.data_2.lokasi;
                                const dataAssetIT = result.data_2;
                                var assetIT = "";

                                // dataAssetIT.forEach(data_asset_it);
                                // function data_asset_it(value, index) {
                                //     assetIT = assetIT + "<tr>";
                                //     assetIT = assetIT + "</tr>";
                                // }

                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<td>" + "Jenis Merek" + "</td>";
                                assetIT = assetIT + "<td>" + ":" + "</td>";
                                assetIT = assetIT + "<td>" + result.data_2.jenis_merk + "</td>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<td>" + "Jenis Tipe" + "</td>";
                                assetIT = assetIT + "<td>" + ":" + "</td>";
                                assetIT = assetIT + "<td>" + result.data_2.jenis_type + "</td>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<td colspan='3'>" + "Spesifikasi" + "</td>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<tr>";
                                assetIT = assetIT + "<td colspan='3'>" + result.data_2.spesifikasi + "</td>";
                                assetIT = assetIT + "<tr>";
                                document.getElementById('data-detail-it').innerHTML = assetIT;
                                $('.scanCheckIT').modal('show');
                            } else {
                                // var r = confirm('Data tidak ditemukan');
                                // if (r == true) {
                                //     html5QrcodeScanner.resume();
                                // } else {
                                //     html5QrcodeScanner.resume();
                                // }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data tidak ditemukan',
                                    // text: 'Something went wrong!',
                                }).then(() => html5QrcodeScanner.resume())
                                // alert('Data tidak ditemukan');
                                // $(document.activeElement).bind('click',function(){
                                //     html5QrcodeScanner.resume();
                                // });
                                // alert('Data tidak ditemukan').then(() => html5QrcodeScanner.resume());
                            }
                        }
                    } else {
                        alert(result.message);
                    }
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }
        // cek_qr_it_asset('PCM-003');
        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.pause(!0);
            cek_qr(decodedText);
            // alert('test');
            // html5QrcodeScanner.pause()
            // .then((ignore) => {
            //     alert(ignore);
            //     // cek_qr(decodedText);
            // });
            // cek_qr_it_asset(decodedText);
            // cek_qr_it_asset(decodedText);
            // if (decodedText !== lastResult) {
            //     ++countResults;
            //     lastResult = decodedText;
            //     cek_qr(decodedText);
            //     // alert(`Scan result ${decodedText}`, decodedResult);
            //     // Handle on success condition with the decoded message.
            //     // console.log(`Scan result ${decodedText}`, decodedResult);
            // }
            // navigator.vibrate(100);

            // console.table(decodedText);
        }

        $('.btn-close').on('click', function() {
            html5QrcodeScanner.resume();
        })

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
</body>

</html>
