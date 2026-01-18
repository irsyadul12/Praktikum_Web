@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Students Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Classes Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKelas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Violations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pelanggaran (Bulan Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPelanggaran }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Achievements Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('prestasi.index') }}" class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prestasi (Bulan Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPrestasi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Siswa per Kelas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar" style="height: 320px;">
                        <canvas id="studentStatsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pelanggaran & Prestasi (6 Bulan Terakhir)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" style="height: 320px;">
                        <canvas id="monthlyRecordsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    async function fetchStudentStats() {
        try {
            const response = await fetch('/api/stats/students-by-class');
            if (!response.ok) throw new Error('Network response was not ok');
            const stats = await response.json();
            renderStudentStatsChart(stats.labels, stats.data);
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }

    function renderStudentStatsChart(labels, data) {
        var ctx = document.getElementById("studentStatsChart");
        if (!ctx) return;
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#fd7e14', '#6f42c1'], // Example colors
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#d73e30', '#6f707f', '#e66b0a', '#5f35b0'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var dataset = chart.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = parseFloat((currentValue / total * 100).toFixed(1));
                            return chart.labels[tooltipItem.index] + ': ' + number_format(currentValue) + ' (' + percentage + '%)';
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom', // Display legend at the bottom
                },
                cutoutPercentage: 80,
            },
        });
    }

    async function fetchMonthlyRecords() {
        try {
            const response = await fetch('/api/stats/monthly-records');
            if (!response.ok) throw new Error('Network response was not ok');
            const stats = await response.json();
            renderMonthlyRecordsChart(stats.labels, stats.pelanggaran, stats.prestasi);
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }

    function renderMonthlyRecordsChart(labels, pelanggaranData, prestasiData) {
        var ctx = document.getElementById("monthlyRecordsChart");
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Pelanggaran",
                    lineTension: 0.3,
                    backgroundColor: "rgba(231, 74, 59, 0.05)",
                    borderColor: "rgba(231, 74, 59, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(231, 74, 59, 1)",
                    pointBorderColor: "rgba(231, 74, 59, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(231, 74, 59, 1)",
                    pointHoverBorderColor: "rgba(231, 74, 59, 1)",
                    data: pelanggaranData,
                }, {
                    label: "Prestasi",
                    lineTension: 0.3,
                    backgroundColor: "rgba(28, 200, 138, 0.05)",
                    borderColor: "rgba(28, 200, 138, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(28, 200, 138, 1)",
                    pointBorderColor: "rgba(28, 200, 138, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                    pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                    data: prestasiData,
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        gridLines: { display: false, drawBorder: false }
                    }],
                    yAxes: [{
                        ticks: { min: 0, maxTicksLimit: 5, padding: 10, callback: function(value) { if (Math.floor(value) === value) { return number_format(value); } } },
                        gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] }
                    }],
                },
                legend: { display: true },
                tooltips: {
                     mode: 'index', intersect: false,
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchStudentStats();
        fetchMonthlyRecords();
    });
</script>
@endpush