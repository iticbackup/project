<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $inventaris->kode_barcode }}</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif
        }
        .table, .td, .th {
          border: 1px solid;
        }
        
        .table {
          width: 100%;
          border-collapse: collapse;
        }
        .text-center{
            text-align: center
        }
        .text-bold{
            font-weight: bold
        }

        .table2 {
          width: 100%;
          border-collapse: collapse;
        }

        .td2, .th2{
            border: 1px solid;
        }
        .tr2 {
          width: 100%;
          border-collapse: collapse;
        }
    </style>
</head>
<body>
    @foreach ($inventarisK3Details as $key => $inventarisK3Detail)
        @if ($inventarisK3Detail->jenis_barang == "APAR")
        <table class="table">
            <tr>
                <td colspan="2" rowspan="4" class="td text-center">
                    <div>
                        <img src="{{ URL::asset('public/itic/icon_itic.png') }}" alt="logo-small" class="text-center" width="50">
                    </div>
                    <div>
                        <span style="font-size: 8pt">PT Indonesian Tobacco Tbk.</span>
                    </div>
                </td>
                <td colspan="5" rowspan="2" style="width: 450px" class="td text-center text-bold">FORMULIR</td>
                <td colspan="2" class="td text-bold" style="border-right: 0px solid">Nomor</td>
                <td class="td text-bold">: IT/HRGA/FR/62</td>
            </tr>
            <tr>
                <td colspan="2" class="td text-bold">Revisi</td>
                <td class="td text-bold">: 3</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="2" class="td text-center text-bold">CHECK LIST APAR</td>
                <td colspan="2" class="td text-bold">Halaman</td>
                <td class="td text-bold">: 1</td>
            </tr>
            <tr>
                <td colspan="2" class="td text-bold">Tanggal</td>
                <td class="td text-bold">: 31/01/2020</td>
            </tr>
        </table>
    
        <div style="margin-top: 2.5%">
            <table class="table2">
                <tr>
                    <td colspan="2" class="text-bold" style="width: 950px">TABUNG NO.</td>
                    <td colspan="3">: {{ $formApars->kode_tabung }}</td>
                    <td class="text-bold">BERAT</td>
                    <td colspan="3">: {{ $formApars->berat }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold">JENIS.</td>
                    <td colspan="3">: {{ $formApars->jenis }}</td>
                    <td class="text-bold">EXPIRED</td>
                    <td colspan="3">: {{ \Carbon\Carbon::create($formApars->expired)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold">WARNA.</td>
                    <td colspan="3">: {{ $formApars->warna }}</td>
                    <td class="text-bold">TEMPAT</td>
                    <td colspan="3">: {{ $formApars->tempat }}</td>
                </tr>
                <tr class="tr2">
                    <th class="th2" style="width: 30px">NO</th>
                    <th class="th2" style="width: 100px">BULAN</th>
                    <th class="th2" style="width: 100px">TGL.</th>
                    <th class="th2" style="width: 100px">PRESSURE</th>
                    <th class="th2" style="width: 100px">NOZZEL</th>
                    <th class="th2" style="width: 100px">SEGEL</th>
                    <th class="th2" style="width: 100px">TUAS</th>
                    <th class="th2" style="width: 100px">PETUGAS</th>
                    <th class="th2" style="width: 100px">VERIFIKASI</th>
                    <th class="th2" style="width: 150px">KETERANGAN</th>
                </tr>
                @forelse ($formAparDetails as $key => $formAparDetail)
                <?php $explode_bulan = explode("|",$formAparDetail->bulan); ?>
                <tr class="tr2">
                    <td class="text-center td2 text-bold">{{ $key+1 }}</td>
                    <td class="text-bold td2">{{ $explode_bulan[1] }}</td>
                    @if($formAparDetail->tanggal)
                    <td class="text-center td2" style="font-size: 12px; width: 120px">{{ \Carbon\Carbon::create($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}</td>
                    @else
                    <td class="td2"></td>
                    @endif
                    <td class="text-center td2">
                        @if ($formAparDetail->pressure == "Y")
                        <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @elseif ($formAparDetail->pressure == "N")
                        <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @endif
                    </td>
                    <td class="text-center td2" style="width: 40px">
                        @if ($formAparDetail->nozzel == "Y")
                        <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @elseif ($formAparDetail->nozzel == "N")
                        <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @endif
                    </td>
                    <td class="text-center td">
                        @if ($formAparDetail->segel == "Y")
                        <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @elseif ($formAparDetail->segel == "N")
                        <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @endif
                    </td>
                    <td class="text-center td" style="vertical-align: middle">
                        @if ($formAparDetail->tuas == "Y")
                        <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @elseif ($formAparDetail->tuas == "N")
                        <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                        @endif
                    </td>
                    <?php 
                        $explode_ttd_apar = explode(" ",$formAparDetail->ttd); 
                        $explode_approval_apar = explode(" ",$formAparDetail->approval); 
                    ?>
                    <td class="td2 text-center" style="font-size: 14px;">{{ $explode_ttd_apar[0] }}</td>
                    <td class="td2 text-center" style="font-size: 14px;">{{ $explode_approval_apar[0] }}</td>
                    <td class="td2 text-center" style="font-size: 14px;">{{ $formAparDetail->keterangan }}</td>
                </tr>
                @empty
                @endforelse
                <tr>
                    <td colspan="10" style="height: 2%"></td>
                </tr>
                <tr>
                    {{-- <td colspan="2" class="text-bold" style="vertical-align: top">
                        <div>Diperiksa oleh :</div>
                        <hr style="margin-top: 50%">
                    </td> --}}
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-bold" style="text-align: right;">
                        <div>Mengetahui,</div>
                        <div>PIC/Manager HRGA</div>
                        <hr style="margin-top: 30%;">
                    </td>
                </tr>
            </table>
        </div>
        @elseif($inventarisK3Detail->jenis_barang == "HYDRANT")
        <table class="table">
            <tr>
                <td colspan="2" rowspan="4" class="td text-center">
                    <div>
                        <img src="{{ URL::asset('public/itic/icon_itic.png') }}" alt="logo-small" class="text-center" width="50">
                    </div>
                    <div>
                        <span style="font-size: 8pt">PT Indonesian Tobacco Tbk.</span>
                    </div>
                </td>
                <td colspan="5" rowspan="2" style="width: 450px" class="td text-center text-bold">FORMULIR</td>
                <td colspan="2" class="td text-bold" style="border-right: 0px solid">Nomor</td>
                <td class="td text-bold">: IT/HRGA/FR/63</td>
            </tr>
            <tr>
                <td colspan="2" class="td text-bold">Revisi</td>
                <td class="td text-bold">: 4</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="2" class="td text-center text-bold">CHECK LIST HYDRANT</td>
                <td colspan="2" class="td text-bold">Halaman</td>
                <td class="td text-bold">: 1</td>
            </tr>
            <tr>
                <td colspan="2" class="td text-bold">Tanggal</td>
                <td class="td text-bold">: 31/01/2020</td>
            </tr>
        </table>
    
        <div style="margin-top: 1%">
            <table class="table2">
                <tr>
                    <td colspan="2" class="text-bold" style="width: 950px">Nomor Hydrant</td>
                    <td colspan="4">: {{ $formHydrants->kode_hydrant }}</td>
                    <td colspan="2" class="text-bold">Periode</td>
                    <td colspan="3">: {{ $formHydrants->periode }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold">Lokasi.</td>
                    <td colspan="3">: {{ $formHydrants->lokasi }}</td>
                </tr>
                <tr class="tr2">
                    <th class="th2" style="width: 30px" rowspan="2">NO</th>
                    <th class="th2" style="width: 100px" rowspan="2">BULAN</th>
                    <th class="th2" style="width: 100px" rowspan="2">TGL.</th>
                    <th class="th2" style="width: 100px" colspan="2">SELANG</th>
                    <th class="th2" style="width: 100px" colspan="2">KRAN</th>
                    <th class="th2" style="width: 100px" colspan="2">NOZZEL</th>
                    <th class="th2" style="width: 100px" rowspan="2">PETUGAS</th>
                    <th class="th2" style="width: 100px" rowspan="2">VERIFIKASI</th>
                    <th class="th2" style="width: 150px" rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <td class="th2 text-center text-bold">MP</td>
                    <td class="th2 text-center text-bold">JP</td>
                    <td class="th2 text-center text-bold">MP</td>
                    <td class="th2 text-center text-bold">JP</td>
                    <td class="th2 text-center text-bold">MP</td>
                    <td class="th2 text-center text-bold">JP</td>
                </tr>
                @forelse ($formHydrantDetails as $keys => $formHydrantDetail)
                <?php $explode_hydrant = explode("|",$formHydrantDetail->bulan); ?>
                <tr>
                    <td class="text-center td text-bold">{{ $keys+1 }}</td>
                    <td class="td text-bold">{{ $explode_hydrant[1] }}</td>
                    <td class="td text-center" style="font-size: 12px;">
                        @if ($formHydrantDetail->tanggal)
                        {{ \Carbon\Carbon::create($formHydrantDetail->tanggal)->format('d-m-Y H:i:s') }}
                        @else
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->selang != null)
                        <?php 
                            $selang = json_decode($formHydrantDetail->selang);
                        ?>
                            @if ($selang->besar == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->selang != null)
                        <?php 
                            $selang = json_decode($formHydrantDetail->selang);
                        ?>
                            @if ($selang->kecil == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->kran != null)
                        <?php 
                            $kran = json_decode($formHydrantDetail->kran);
                        ?>
                            @if ($kran->besar == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->kran != null)
                        <?php 
                            $kran = json_decode($formHydrantDetail->kran);
                        ?>
                            @if ($kran->kecil == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->nozzel != null)
                        <?php 
                            $nozzel = json_decode($formHydrantDetail->nozzel);
                        ?>
                            @if ($nozzel->besar == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <td class="td text-center" style="width: 50px">
                        @if ($formHydrantDetail->nozzel != null)
                        <?php 
                            $nozzel = json_decode($formHydrantDetail->nozzel);
                        ?>
                            @if ($nozzel->besar == 'Y')
                            <img src="{{ URL::asset('public/assets/images/checkmark-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @else
                            <img src="{{ URL::asset('public/assets/images/close-outline.png') }}" alt="logo-small" class="text-center" style="margin: 5%" width="13">
                            @endif
                        @endif
                    </td>
                    <?php 
                        $explode_ttd_hydrant = explode(" ",$formHydrantDetail->checker); 
                        $explode_approval_hydrant = explode(" ",$formHydrantDetail->approval); 
                    ?>
                    <td class="td text-center" style="font-size: 14px;">{{ $explode_ttd_hydrant[0] }}</td>
                    <td class="td text-center" style="font-size: 14px;">{{ $explode_approval_hydrant[0] }}</td>
                    <td class="td text-center" style="font-size: 14px;">{{ $formHydrantDetail->keterangan }}</td>
                </tr>
                @empty
                @endforelse
                <tr>
                    <td colspan="12" style="padding-left: 3.5%">Catatan</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>Ket: -MP = Main Pump
                            <div style="padding-left: 12%">-JP = Jockey Pump</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    {{-- <td colspan="2" class="text-bold" style="vertical-align: top">
                        <div>Diperiksa oleh :</div>
                        <hr style="margin-top: 50%">
                    </td> --}}
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-bold" style="text-align: right;">
                        <div>Mengetahui,</div>
                        <div>PIC/Manager HRGA</div>
                        <hr style="margin-top: 45%">
                    </td>
                </tr>
            </table>
        </div>
        @endif
    @endforeach
</body>
</html>