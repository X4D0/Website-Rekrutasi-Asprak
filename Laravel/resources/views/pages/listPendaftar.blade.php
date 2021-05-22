@extends('layout.app-aslab')

@section('title','Data Asprak')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
        <h1 class="display-4">Data Pendaftar</h1>
        <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
    </div>
</div>

<div class="container-fluid px-5 mb-5">
    <table id="tabel" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>E-Mail</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Pilihan Praktikum</th>
                <th>Tanggal Register</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($test)}} --}}
            @foreach($test as $a)
            <tr>
                <td>{{ $a->email }}</td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->nimPendaftar }}</td>
                <td>{{ $a->pilihan_praktikum }}</td>
                <td>{{ $a->created_at }}</td>
                <td>
                    {{-- {{dd($a)}} --}}
                    @if ($a->status == NULL)
                    <span class="btn btn-warning">Belum Test</span>
                    @else
                    <span class="btn btn-success">Sudah Test</span>
                    @endif

                    @if ($a->id_soal == NULL)
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#setSoalModal{{$a->id_test}}">
                        Set Soal
                    </button>
                    @endif


                </td>

                <td class="text-left">
                    @if ($a->status == NULL || $a->status == 0)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#setSoalModal{{$a->id_test}}">
                        Edit Soal
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="setSoalModal{{$a->id_test}}" tabindex="-1"
                        aria-labelledby="setSoalModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('setSoalAsprak',$a->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Asprak</label>
                                            <h5>{{$a->name}}</h5>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ID Pendaftaran</label>
                                            <h5>{{$a->id_pendaftaran}}</h5>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mata Kuliah Praktikum</label>
                                            <h5>{{$a->pilihan_praktikum}}</h5>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Set Soal</label>
                                            <select class="form-control" name="id_soal">
                                                <option>Pilih Soal Berdasarkan Matkul Praktikum</option>
                                                @foreach ($soals as $soal)
                                                <option value="{{$soal->id_soal}}">{{$soal->id_soal}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#viewJawaban{{$a->id_test}}">
                        Lihat Jawaban
                    </button>
                    {{-- <a href="#">See Result</a> --}}
                    @endif
                    <a class="btn btn-primary" href="{{route('editDataPendaftaran',$a->id)}}">View & Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection