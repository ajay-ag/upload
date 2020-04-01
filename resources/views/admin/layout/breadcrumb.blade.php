
@if (! empty($breadcrumbs))
<ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
          @foreach ($breadcrumbs as $label => $link)

             @if (is_int($label) && ! is_int($link))
                <li class="breadcrumb-item">{{ $link }}</li>
             @else
                <li class="breadcrumb-item active">{{ $label }}</li>
             @endif
        @endforeach
</ol>
@else
<ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
</ol>
@endif

{{--
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
            @include('admin.layout.breadcrumb', ['breadcrumbs' => [

                 'Settings' =>'',
                 'Mailsetup' => '',
                
                ]])

@endsection
--}}