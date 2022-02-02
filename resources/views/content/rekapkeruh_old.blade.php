@extends('layout.master') @section('title','Rekapitulasi Kekeruhan Air') @section('halaman','Rekapitulasi Kekeruhan Air') @section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Rekapitulasi Kekeruhan Air</h3>
			</div>
				<form action="search_created_at" method="POST">
					<div class="card-body">
							<div class="form-inline">
								<div class="row form-group mx-2">
									<label for="Tanggal Awal">Awal</label>
									<input type="text" id="min" class="form-control mx-2" name="min" data-language='en'/>
								</div>
								<div class="row form-group mx-2">
									<label for="Tanggal Akhir">Akhir</label>
									<input type="text" id="max" class="form-control mx-2" name="max" data-language='en'/>
								</div>
							</div>
                            <br>
			</form>
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
			 @foreach ($data as $d )
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$d->created_at}}</td>
				<td>{{$d->NTU}}</td>
				<td>{{$d->status_kekeruhan}}</td>
			</tr>
			 @endforeach
			</tbody>
			</table>
            </div>
		</div>
		<!-- /.card-bod-->
	</div>
</div>
</div>
<!-- jQuery -->

{{-- <script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <!-- Bootstrap 4 -->
<script src="{{asset('public/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->

{{-- <script src="{{asset('template')}}/plugins/datatables/jquery.dataTables.min.js"></script> --}}

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script src="{{asset('public/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/template/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/template/plugins/pdfmake/pdfmake.min.js')}}"></script>

<script>
  var minDate, maxDate;
    // DataTables initialisation
    var table = $('#tabel1').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print']
    });
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'DD-MM-YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'DD-MM-YYYY'
    });


// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);
        if (
            ( min === null && max === null ) ||
            ( min == null && date <= max ) ||
            ( min <= date   && max == null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
// Refilter the table
$('#min, #max').on('change', function () {
        table.draw();
    });

</script>
@endsection
