@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Disposisi Surat</h1>
@endsection

@section('content')

<div class="row">
    <!-- KPI -->
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalSurat }}</h3>
                <p>Total Surat</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pending }}</h3>
                <p>Pending</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $process }}</h3>
                <p>Diproses</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $done }}</h3>
                <p>Selesai</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Trend Surat Masuk</div>
            <div class="card-body">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Status Disposisi</div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Overdue -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                Surat Terlambat
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Surat</th>
                            <th>Tujuan</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($overdueList as $item)
                        <tr>
                            <td>{{ $item->suratMasuk->id }}</td>
                            <td>{{ $item->ke->name }}</td>
                            <td class="text-danger">{{ $item->deadline }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const trendData = @json(array_values($trend->toArray()));

new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: [...Array(trendData.length).keys()],
        datasets: [{
            label: 'Surat Masuk',
            data: trendData
        }]
    }
});

new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Process', 'Done'],
        datasets: [{
            data: [{{ $pending }}, {{ $process }}, {{ $done }}],
            backgroundColor: [
                '#f39c12', 
                '#007bff', 
                '#28a745'  
            ],
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    }
});

</script>
@endpush