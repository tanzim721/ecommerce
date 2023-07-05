@extends('admin.master')

@section('admin_contant')
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 15%">Category Name</th>
                    <th style="width: 35%">Description</th>
                    <th style="width: 15%">Image</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 20%">Actions</th>
                </tr>
            </thead>
            @foreach ($categories as $category)
                <tbody>
                    <tr>
                        <td>{{$category->id}}</td>
                        <td class="center">{{$category->name}}</td>
                        <td class="center">{{$category->description}}</td>
                        <td>
                            <img src="{{asset('/storage/'.$category->image)}}" alt="">
                        </td>
                        <td class="center">
                            <span class="label label-success">Active</span>
                        </td>
                        <td class="center">
                            <a class="btn btn-success" href="#">
                                <i class="halflings-icon white zoom-in"></i>  
                            </a>
                            <a class="btn btn-info" href="#">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger" href="#">
                                <i class="halflings-icon white trash"></i> 
                            </a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            
        </table>            
    </div>
@endsection