@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/ol@v7.4.0/dist/ol.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.4.0/ol.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <style>
                    .map {
                        width: 100%;
                        height: 400px;
                    }
                </style>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div id="map" class="map"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="module">
        const layers = [
            new TileLayer({
                source: new OSM(),
            }),
            new TileLayer({
                extent: [-13884991, 2870341, -7455066, 6338219],
                source: new TileWMS({
                    url: 'http://localhost:81/geoserver/cite/wms?service=WMS',
                    params: {'LAYERS': 'cite:MunicipiosAnalisados', 'TILED': true},
                    serverType: 'geoserver',
                    transition: 0,
                }),
            }),
        ];
        const map = new Map({
            layers: layers,
            target: 'map',
            view: new View({
                center: [-5997148, -3555000],
                zoom: 6,
            }),
        });

    </script>
@endpush
