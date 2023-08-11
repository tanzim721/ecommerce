@extends('admin.master')

@section('admin_contant')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    {{-- CLE editor use korchi.... or Ck editor use kora zai........... --}}
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header text-black bg-info" data-original-title>
                <p class="alert-success">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo $message;
                            Session::put('message',null);
                        }
                    ?>
                </p>
                <h2><i class="halfLings-icon edit "></i><span class="break"></span>Edit Category</h2>
            </div>
            <div class="box-content">
                <form method="POST" action="{{url('/categories/store/'.$category->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <lable class="control-label" for="date01">Category Name</lable>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="name" value="{{$category->name}}">
                            </div>
                        </div>
                        {{-- <div class="control-group">
                            <lable class="control-label" for="date01">Category Status</lable>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="status" required>
                            </div>
                        </div>           --}}
                        <div class="control-group hidden-phone">
                            <label for="textarea2" class="control-label">Category Description</label>
                            <div class="controls">
                                <textarea name="description" id="" cols="" rows="3" class="cleditor" required>{{$category->description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="" class="control-label">File Upload</label>
                            <div class="controls">
                                <input type="file" name="image">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" >Update</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

   
@endsection


