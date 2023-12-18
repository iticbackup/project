<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        /* table, td, th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        } */

        @media print {
            div.page-break {
                display: block;
                page-break-before: auto;
            }
            body {transform: scale(.99);}
        }

        * {
            -webkit-print-color-adjust: exact !important;
            /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important;
            /* Firefox 48 – 96 */
            print-color-adjust: exact !important;
            /* Firefox 97+, Safari 15.4+ */
        }

        .bg-barcode {
            background-color: rgb(0, 195, 255)
        }
    </style>
</head>

<body>
    {{-- <table>
        <tr>
            @foreach ($pdfs as $pdf)
            <td>
                <div>{!! $pdf['lokasi'] !!}</div>
                <div>{!! $pdf['barcode'] !!}</div>
            </td>
            <td>
                <div>{!! $pdf['lokasi'] !!}</div>
                <div>{!! $pdf['barcode'] !!}</div>
            </td>
            <td>
                <div>{!! $pdf['lokasi'] !!}</div>
                <div>{!! $pdf['barcode'] !!}</div>
            </td>
            @endforeach
        </tr>
    </table> --}}
    <div class="row">
        @foreach ($pdfs as $pdf)
            <div class="col-3 mb-4">
                <div class="card text-center bg-barcode">
                    {{-- <div class="card-header">
                </div> --}}
                    <div class="card-title mt-3"
                        style="
                    background-color: white; 
                    padding-top: 2%; 
                    padding-bottom: 2%;
                    margin-left: 1%; 
                    margin-right: 1%;
                    ">
                        <div>
                            <img src="{{ URL::asset('public/itic/icon_itic.png') }}" alt="logo-small"
                                class="logo-sm" width="15">
                            <span style="font-weight: bold; font-size: 7pt;">PT Indonesian Tobacco Tbk.</span>
                        </div>
                        <b>{!! $pdf['kode_barcode'] !!}</b>
                        <div style="text-align: right; font-size: 4pt; margin-right: 3%; margin-bottom: -2%; margin-top: -2.5%; font-weight: bold">IT/IT/FR/17</div>
                    </div>
                    <div class="card-body">
                        <div class="text-center" style="background-color: white; padding: 5%">
                            {!! $pdf['barcode'] !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
