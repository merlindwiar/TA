@extends('layout.master')
@section('title','Kondisi Air')
@section('halaman','Pantau Kondisi Air Sungai')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-3 ">
            <a href="{{url('cetak-data-kekeruhan-form')}}">
            <button type="button" class="btn btn-block btn-primary">Data Rekapitulasi Kekeruhan</button>
            </a>
          </div>
    </div>
<br>

{{-- <div class="card">
    <div class="panel">
        <div id="chartTinggi">
        </div>
    </div>
</div> --}}
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <h3>Grafik Kekeruhan Air</h3>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Kondisi Air Sungai</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tabel1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Waktu</th>
              <th>NTU</th>
              <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $item )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->NTU}}</td>
                    <td>{{$item->status_kekeruhan}}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-bod-->
      </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{asset('public/template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('public/template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/template/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/template/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> --}}

<script src="{{ asset('public/chart.js/chart.js') }}"></script>
<script src="{{ asset('public/chart.js/chartjs-plugin-annotation.js') }}"></script>

<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          fill: false,
          pointBorderColor: 'blue',
          borderColor: 'blue',
          label: 'NTU',
          data: [],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          autocolors: false,
          annotation: {
            annotations: {
                box1: {
                    type: 'box',
                    yMin: 0,
                    yMax: 24,
                    backgroundColor: 'rgba(255, 255, 102, 0.25)'
                  },
                  box2: {
                    type: 'box',
                    yMin: 25,
                    yMax: 400,
                    backgroundColor: 'rgba(153, 255, 153, 0.25)'
                  },
                  box3: {
                    type: 'box',
                    yMin: 401,
                    yMax: 1000,
                    backgroundColor: 'rgba(255, 0, 0, 0.4)'
                  }
            }
          }
        },
      }
    });
    var updateChart = function() {
      $.ajax({
        url: "{{ route('api.chart') }}",
        type: 'GET',
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          myChart.data.labels = data.labels;
          myChart.data.datasets[0].data = data.data;
          myChart.update();
        },
        error: function(data){
          console.log(data);
        }
      });
    }

    updateChart();
    setInterval(() => {
      updateChart();
    }, 1000);
  </script>
<script>

  let data = @json($data);
  console.log(data);

  let created_at = [];
  let kekeruhan = [];
  data.forEach(element => {
    created_at.push(element['created_at'])
    kekeruhan.push(element['NTU'])
  });

        Highcharts.chart('chartTinggi', {

        title: {
        text: 'Grafik Kekeruhan Air'
        },

        yAxis: {
        title: {
            text: 'Kekeruhan Air'
        }
        },

        xAxis: {
            categories: created_at,
        },

        legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
        },

        plotOptions: {
        series: {
            label: {
            connectorAllowed: false
            },
        }
        },

        series: [{
        name: 'NTU',
        data: kekeruhan,
        }],

        responsive: {
        rules: [{
            condition: {
            maxWidth: 500
            },
            chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
            }
        }]
        }
    });
</script>
<script>
      $('#tabel1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
  </script>
@endsection
