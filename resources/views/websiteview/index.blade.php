@extends('websiteview.layout.app')
@section('title','Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/website/js/select2/dist/css/select2.min.css') }}">
    <link href="{{asset('assets/website/css/custome_select_home.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
@endsection
@section('site-block')
@include('websiteview.layout.site-block')
@endsection
@section('category')
@include('websiteview.layout.category')
@endsection
@section('how_it_work')
@include('websiteview.layout.how_it_work')
@endsection

@section('js')

 <script src="{{ asset('assets/website/js/select2/dist/js/select2.min.js') }}"></script>

    <script>
        function getName(data) {
            if (!data.id) {
                return data.text;
            }
            data = data.otherfield;
            var $html = $("<div >" + data.name + "</div>");
            return $html;
        }


        $('#city').select2({

            ajax: {
                url: '{{route('select2cityHomepage') }}',
                data: function (params) {
                    return {
                        search: params.term,
                        //page: params.page || 1
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    console.log(data);
                    //data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: `${item.name}`,
                                otherfield: item,
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                //cache: true,
                delay: 50
            },
            placeholder: 'Select City',
            // minimumInputLength: 1,
            templateResult: getName,
            minimumInputLength: 3,
        });

    </script>

@endsection
