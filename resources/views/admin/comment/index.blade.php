@extends('admin.layouts.app')

@section('title')
    Category
@endsection

@section('content')
    <div class="row ">
        <div class="col-12 my-5">
            @if (session('deleteSuccess'))
                <div class="row justify-content-end">
                    <div class="col-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteSuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comments</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>post</th>
                                <th>user</th>
                                <th>Description</th>
                                {{-- <th>Created at</th> --}}
                                {{-- <th>Address</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($comments as $comment)
                                <tr>
                                   <td>{{$num}}</td>
                                   <td class="col-3 text-wrap">{{ $comment->post_title }}</td>
                                   <td>{{ $comment->user_name }}</td>
                                   <td>{{ $comment->description }}</td>
                                   <td>
                                    <a href="{{route('admin#deleteComment', $comment->id)}}" class="btn btn-danger">Delete</a>
                                   </td>
                                </tr>
                                <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
