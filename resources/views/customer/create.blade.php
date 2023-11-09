@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Customer</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Customer</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control 
@error('name') is-invalid @enderror" name="name" value="{{
old('name') }}" placeholder="Masukkan Nama Customer">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Email</label>
                                    <input type="text" class="form-control 
@error('email') is-invalid @enderror" name="email" value="{{ 
old('email') }}" placeholder="Masukkan Email Customer">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            
                            
                                <div class="form-group col-md-6">
                                        <label class="font-weight-bold">No Telepon</label>
                                        <input type="text" class="form-control 
@error('phone') is-invalid @enderror" name="phone" value="{{ 
old('phone') }}" placeholder="Masukkan No Telepon">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            <!-- </div> -->
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Ticket</label>

                                    <select class="form-control @error('ticket') is-invalid @enderror" id="ticket" name="ticket">
                                        <option value="" disabled selected>Pilih Ticket</option>

                                        @foreach($tickets as $ticket) <option value="{{ $ticket->id }}" {{ old('id_ticket') == $ticket->id ? 'selected' : ''}} >
                                        {{ $ticket->movie->title}} ({{ $ticket->class }}: {{ $ticket->price }}) 
                                        
                                        </option>
                                        @endforeach

                                    </select>
                                    @error('ticket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            

                                <div class="form-group col-md-3">
                                        <label class="font-weight-bold">Quantity</label>
                                        <input type="number" class="form-control 
    @error('quantity') is-invalid @enderror" name="quantity" value="{{ 
    old('quantity') }}" placeholder="Masukkan Quantity">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection