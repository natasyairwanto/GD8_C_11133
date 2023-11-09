@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('ticket')}}">Customer</a>
                    </li>
                    <li class="breadcrumb-item active">Index</li>
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
                        <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3">TAMBAH CUSTOMER</a>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">No Telepon</th>
                                        <th class="text-center">Quantity Ticket</th>
                                        <th class="text-center">Class Ticket</th>
                                        <th class="text-center">Poster Film</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customer as $item)
                                    <tr>
                                        <!-- <td class="text-center">{{$item->ticket->class }}</td> -->
                                        <td class="text-center">{{$item->name }}</td>
                                        <td class="text-center">{{$item->email }}</td>
                                        <td class="text-center">{{$item->phone }}</td>
                                        <td class="text-center">{{$item->quantity }}</td>
                                        <td class="text-center">
                                            @if ($item->ticket->class)
                                                {{ $item->ticket->class }}
                                            @endif
                                        </td>

                                        <td class="text-center">
                        
                                            @if ($item->ticket && $item->ticket->movie)
                                                @if ($item->ticket->movie->image)
                                                    <img src="{{ asset('storage/'.$item->ticket->movie->image) }}" width="150" alt="">
                                                @else
                                                    No Image Available
                                                @endif
                                            @else
                                                No Movie Assigned
                                            @endif
                                        </td>


                                        <td class="text-center">
                                            <form onsubmit="return 
                                            confirm('Apakah Anda Yakin ?');" action="{{ route('customer.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('customer.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Customer belum tersedia
                                    </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $customer->links() }}
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