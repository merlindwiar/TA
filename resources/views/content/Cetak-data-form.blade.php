@extends('layout.master') @section('title','Rekapitulasi Keasaman Air') @section('halaman','Rekapitulasi Kekeruhan Air') @section('content')
<div class="content">

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Rekapitulasi Keasaman Air</h3>
			</div>
			<!-- /.card-header -->
            <div class="card-body">

            <form action="{{url('cetak-data-keasaman-pertanggal')}}" method="post" class="" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="input-group-mb-3">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="tglawal" id="tglawal" class="form-control" required>
                    </div>
                    <div class="input-group-mb-3">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="tglakhir" id="tglakhir" class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group-mb-3">
                        {{-- <a onclick="this.href={{url('cetak-data-pertanggal/')}} + document.getElementById('tglawal').value + '/' +
                        document.getElementById('tglakhir').value" target="_blank" --}}

                        {{-- <a onclick="this.href='/cetak-data-pertanggal/' + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value"
                        class="btn btn-block btn-primary col-md-12">Cetak Data Pertanggal <i class="fas fa-print"></i></a> --}}

                        <button type="submit"> Cetak Data Pertanggal <i class="fas fa-print"></i></button>

                    </div>
            </form>
        </div>
		</div>
		<!-- /.card-bod-->
	</div>
</div>
</div>

@endsection
