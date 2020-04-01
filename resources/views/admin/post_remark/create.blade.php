@extends('admin.layout.app')
@section('title','Add Post Remark')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Add Post Remark',
    'back' =>  route('admin.post-remark.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')
 
<div class="container-fluid">

    <form action="{{ route('admin.post-remark.store') }}" enctype="multipart/form-data" method="POST" name="attribute_form"
          id="attribute_form" autocomplete="off">
        @csrf
        <div class="row">

            <div class="col-sm-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-mute"><strong>Post Remark</strong></h6>
                        <hr>

                        <div class="form-group">
                            <label for="title">Name <span class="text-danger">*</span> </label>
                            <input id="name" class="form-control" type="text" name="name"
                                   data-msg-required="Name is required." data-rule-required="true" maxlength="190">
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-sm-4">


            </div>
        </div>
        <div class="dropzoneel">

        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-success shadow" name="save"><span id="sid" role="status" aria-hidden="true"></span> Save
                </button>
            </div>


        </div>
    </form>
</div>
    <div id="load-modal"></div>

@endsection



@push('js')
<script src="{{ asset('assets/admin/js/setting/postremark.js') }}"></script>

@endpush



