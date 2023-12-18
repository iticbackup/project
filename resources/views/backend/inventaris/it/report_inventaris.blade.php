<style>
    body {
        font-family: Arial, Helvetica, sans-serif
    }

    .table,
    .td,
    .th {
        border: 1px solid;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .text-center {
        text-align: center
    }

    .text-bold {
        font-weight: bold
    }

    .table2 {
        width: 100%;
        border-collapse: collapse;
    }

    .td2,
    .th2 {
        border: 1px solid;
    }

    .tr2 {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<table class="table">
    <tr>
        <td colspan="2" rowspan="4" class="td text-center" style="width: 150px">
            <div>
                <img src="{{ URL::asset('public/itic/icon_itic.png') }}" alt="logo-small"
                    class="text-center" width="50">
            </div>
            <div>
                <span style="font-size: 8pt; font-weight: bold">PT Indonesian Tobacco Tbk.</span>
            </div>
        </td>
        <td colspan="5" rowspan="2" style="width: 250px; font-size: 11pt" class="td text-center text-bold">FORMULIR
        </td>
        <td colspan="2" class="text-bold" style="border-right: 0px solid; font-size: 11pt">Nomor</td>
        <td class="text-bold" style="font-size: 11pt">: IT/IT/FR/18</td>
    </tr>
    <tr>
        <td colspan="2" class="text-bold" style="font-size: 11pt">Revisi</td>
        <td class="text-bold" style="font-size: 11pt">: CON-CURRENT</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="2" class="td text-center text-bold" style="font-size: 11pt">DATA INVENTARIS</td>
        <td colspan="2" class="text-bold" style="font-size: 11pt">Halaman</td>
        <td class="text-bold" style="font-size: 11pt">: 1</td>
    </tr>
    <tr>
        <td colspan="2" class="text-bold" style="font-size: 11pt">Tanggal</td>
        <td class="text-bold" style="font-size: 11pt">: 09/09/2023</td>
    </tr>
</table>
<p style="font-weight: bold; text-align: center; text-transform: uppercase">Data Inventaris</p>
<table class="table">
    <tr>
        <td class="td" style="text-align: center; font-weight: bold">No</td>
        <td class="td" style="text-align: center; font-weight: bold; width: 150px">Kode Inventaris</td>
        <td class="td" style="text-align: center; font-weight: bold; width: 100px">Jenis</td>
        <td class="td" style="text-align: center; font-weight: bold; width: 250px">Lokasi</td>
        <td class="td" style="text-align: center; font-weight: bold; width: 100px">Status</td>
    </tr>
    @foreach ($inventaris_it_asset_details as $key => $inventaris_it_asset_detail)
        @php
            // $id = $inventaris_it_asset_detail->inventaris_it_asset_id;
            $inventaris_it_asset = \App\Models\InventarisITAsset::find($inventaris_it_asset_detail->inventaris_it_asset_id);
            if (empty($inventaris_it_asset)) {
                $nama_perangkat = '-';
            }else{
                $nama_perangkat = $inventaris_it_asset->nama_perangkat;
            }
            // $id = $inventaris_it_asset_detail->inventaris_it_asset_id.' + '.$inventaris_it_asset_detail->nama_label;
            $inventaris_it_asset_form = \App\Models\InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$inventaris_it_asset_detail->id)->first();
            if (empty($inventaris_it_asset_form)) {
                $lokasi = null;
                $jenis_merk = null;
            }else{
                $lokasi = $inventaris_it_asset_form->lokasi;
                $jenis_merk = $inventaris_it_asset_form->jenis_merk;
            }

            if ($inventaris_it_asset_detail->status == 0) {
                $status = '<span style="color: blue">Available</span>';
            }elseif ($inventaris_it_asset_detail->status == 1) {
                $status = '<span style="color: green">Used</span>';
            }elseif ($inventaris_it_asset_detail->status == 2) {
                $status = '<span style="color: red">Any</span>';
            }
        @endphp
        <tr>
            <td class="td" style="text-align: center">{{ $key+1 }}</td>
            <td class="td" style="text-align: center">{{ $inventaris_it_asset_detail->nama_label }}</td>
            <td class="td" style="text-align: center">{{ $nama_perangkat }}</td>
            <td class="td" style="text-align: center">{{ $lokasi }}</td>
            <td class="td" style="text-align: center">{!! $status !!}</td>
        </tr>
    @endforeach
</table>
<table class="table" style="margin-top: 5%">
    <tr>
        <td style="width: 120px; font-size: 11pt; height: 30px">Disiapkan oleh</td>
        <td style="font-size: 11pt; height: 30px">:</td>
        <td style="width: 150px; height: 30px"></td>
        <td style="width: 120px; font-size: 11pt; height: 30px">Disetujui oleh</td>
        <td style="font-size: 11pt; height: 30px">:</td>
        <td style="width: 150px; height: 30px"></td>
    </tr>
    <tr>
        <td style="font-size: 11pt; height: 30px">Jabatan</td>
        <td style="font-size: 11pt; height: 30px">:</td>
        <td style="font-size: 11pt; height: 30px">Staff IT</td>
        <td style="font-size: 11pt; height: 30px">Jabatan</td>
        <td style="font-size: 11pt; height: 30px">:</td>
        <td style="font-size: 11pt; height: 30px">Supervisor IT</td>
    </tr>
</table>