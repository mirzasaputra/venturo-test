@extends('layouts.base')

@section('content')
    <form action="">
        <div class="row">
            <div class="col-2">
                <select name="tahun" class="form-control">
                    <option value="">Pilih Tahun</option>
                    <option value="2021" {{ $tahun == 2021 ? 'selected' : '' }}>2021</option>
                    <option value="2022" {{ $tahun == 2022 ? 'selected' : '' }}>2022</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Tampilkan</button>
                @if(!is_null($data))
                    <a href="{{ url('api/v1/menu') }}" class="btn btn-secondary">JSON Menu</a>
                    <a href="{{ url('api/v1/transaction?tahun='. $tahun) }}" class="btn btn-secondary">JSON Transaction</a>
                    <a href="{{ url('download?tahun='. $tahun) }}" class="btn btn-secondary">Download Example</a>
                @endif
            </div>
        </div>
    </form>
    <hr>
    @if(!is_null($data))
        <table class="table table-bordered">
            <thead class="table-dark text-center" style="font-size: 11px">
                <tr>
                    <th rowspan="2" valign="middle" width="20%">Menu</th>
                    <th colspan="12">Periode Tahun {{ $tahun }}</th>
                    <th rowspan="2" valign="middle">Total</th>
                </tr>
                <tr>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>Mei</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ags</th>
                    <th>Sep</th>
                    <th>Okt</th>
                    <th>Nov</th>
                    <th>Des</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px">
                @foreach($data as $key => $item)
                    <tr class="bg-light">
                        <th colspan="14" class="bg-light">{{ ucfirst($key) }}</th>
                    </tr>
                    @foreach($data[$key] as $item)
                        <tr>
                            <td>{{ $item['menu'] }}</td>
                            <td class="text-end">{{ $item['jan'] > 0 ? number_format($item['jan'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['feb'] > 0 ? number_format($item['feb'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['mar'] > 0 ? number_format($item['mar'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['apr'] > 0 ? number_format($item['apr'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['mei'] > 0 ? number_format($item['mei'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['jun'] > 0 ? number_format($item['jun'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['jul'] > 0 ? number_format($item['jul'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['ags'] > 0 ? number_format($item['ags'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['sep'] > 0 ? number_format($item['sep'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['okt'] > 0 ? number_format($item['okt'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['nov'] > 0 ? number_format($item['nov'], 0, '.', ',') : '' }}</td>
                            <td class="text-end">{{ $item['des'] > 0 ? number_format($item['des'], 0, '.', ',') : '' }}</td>
                            <th class="text-end">{{ number_format($item['total'], 0, '.', ',') }}</th>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot class="table-dark" style="font-size: 11px">
                <th>Total</th>
                <th class="text-end">{{ ($data['makanan']->sum('jan') + $data['minuman']->sum('jan')) > 0 ? number_format($data['makanan']->sum('jan') + $data['minuman']->sum('jan'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('feb') + $data['minuman']->sum('feb')) > 0 ? number_format($data['makanan']->sum('feb') + $data['minuman']->sum('feb'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('mar') + $data['minuman']->sum('mar')) > 0 ? number_format($data['makanan']->sum('mar') + $data['minuman']->sum('mar'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('apr') + $data['minuman']->sum('apr')) > 0 ? number_format($data['makanan']->sum('apr') + $data['minuman']->sum('apr'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('mei') + $data['minuman']->sum('mei')) > 0 ? number_format($data['makanan']->sum('mei') + $data['minuman']->sum('mei'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('jun') + $data['minuman']->sum('jun')) > 0 ? number_format($data['makanan']->sum('jun') + $data['minuman']->sum('jun'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('jul') + $data['minuman']->sum('jul')) > 0 ? number_format($data['makanan']->sum('jul') + $data['minuman']->sum('jul'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('ags') + $data['minuman']->sum('ags')) > 0 ? number_format($data['makanan']->sum('ags') + $data['minuman']->sum('ags'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('sep') + $data['minuman']->sum('sep')) > 0 ? number_format($data['makanan']->sum('sep') + $data['minuman']->sum('sep'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('okt') + $data['minuman']->sum('okt')) > 0 ? number_format($data['makanan']->sum('okt') + $data['minuman']->sum('okt'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('nov') + $data['minuman']->sum('nov')) > 0 ? number_format($data['makanan']->sum('nov') + $data['minuman']->sum('nov'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ ($data['makanan']->sum('des') + $data['minuman']->sum('des')) > 0 ? number_format($data['makanan']->sum('des') + $data['minuman']->sum('des'), 0, '.', ',') : '' }}</th>
                <th class="text-end">{{ number_format($data['makanan']->sum('total') + $data['minuman']->sum('total'), 0, '.', ',') }}</th>
            </tfoot>
        </table>
    @endif
@endsection