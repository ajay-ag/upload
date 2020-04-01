<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$user->name ?? ''}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('websiteview/assets/css/card-design2.css') }}">
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e0eea7fe13da80012ea3471&product=inline-share-buttons&cms=website' async='async'></script>
    <link rel="icon" href="{{asset('websiteview/assets/images/favicon.png') }}" type="image/x-icon">


</head>
<body>

<div class="container">
    <div class="d-flex justify-content-center row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 25rem;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div>Share:</div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-12">
                        <div st_url='{{Request::url()}}' class="sharethis-inline-share-buttons"></div>
                        <br>
                    </div>
                </div>
                <!--                <img class="card-img-top" src="..." alt="Card image cap">-->


                <img style="height: 300px;" class="card-img-top"

                     src="{{$user->Profile_src_card}}"
                     alt="{{$user->name ?? ''}}">
                <div class="card-body">
                    @if($user->business_name !="")
                        <h5 class="card-title text-center">{{$user->business_name ?? ''}}</h5>
                    @else
                        <h5 class="card-title text-center">{{$user->name ?? ''}}</h5>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item lab shadow rounded">Personal Detail
                    </li>
                    <li class="list-group-item ">
                        <div class="">
                            <div class="row">
                                @if($user->mobile !="")
                                    <div class=" col-md-4 vjCTAinfobox">
                                        <a target="_blank" href="tel:{{$user->mobile}}"
                                           class=" fa fa-phone  justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Call Me</span>
                                    </div>
                                @endif

                                @if($user->email !="")
                                    <div target="_blank" class="col-md-4 vjCTAinfobox">
                                        <a href="mailto:{{$user->email}}"
                                           class="fa fa-envelope  justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Email Me</span>
                                    </div>
                                @endif


                                @if($user->personal_whatapp_mobile !="")
                                    <div class="col-md-4 vjCTAinfobox">
                                        <a target="_blank"
                                           href="https://api.whatsapp.com/send?phone=+91{{$user->personal_whatapp_mobile}}&amp;text=Got%20reference%20from%20your%20City%20Post.%20Want%20to%20know%20more%20about%20your%20products%20and%20services."
                                           class="fa fa-whatsapp  justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Whatsapp</span>
                                    </div>
                                @endif




                            </div>
                    </li>


                    <li class="list-group-item lab shadow rounded">Business Detail
                    </li>
                    <li class="list-group-item">


                        <div class=" ">

                            <div class="row">
                                @if($user->business_mobile !="")
                                    <div class="col-md-4 vjCTAinfobox">
                                        <a target="_blank" href="tel:{{$user->business_mobile}}"
                                           class=" fa fa-phone  justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Call Me</span>
                                    </div>
                                @endif

                                    @if($user->business_email !="")
                                        <div class="col-md-4 vjCTAinfobox">
                                            <a target="_blank" href="mailto:{{$user->business_email}}"
                                               class="fa fa-envelope  justify-content-lg-around"></a>
                                            <span class="vjctamaintext">Email Me</span>
                                        </div>
                                    @endif


                                @if($user->business_whatapp_mobile !="")
                                    <div class="col-md-4 vjCTAinfobox">
                                        <a target="_blank"
                                           href="https://api.whatsapp.com/send?phone=+91{{$user->business_whatapp_mobile}}&amp;text=Got%20reference%20from%20your%20City%20Post.%20Want%20to%20know%20more%20about%20your%20products%20and%20services."
                                           class="fa fa-whatsapp  justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Whatsapp</span>
                                    </div>
                                @endif




                                @if($user->business_address!="")
                                    <div class="col-md-4 vjCTAinfobox">
                                        <a target="_blank" href="http://maps.google.com/?q={{$user->business_address}}"
                                           class="fa fa-building-o   justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Company</span>
                                    </div>
                                @endif

                                @if($user->business_site_url !="")
                                    <div class="col-md-4 vjCTAinfobox">
                                        <a target="_blank" href="{{$user->business_site_url}}"
                                           class="fa fa-globe justify-content-lg-around"></a>
                                        <span class="vjctamaintext">Web site</span>
                                    </div>
                                @endif

                            </div>


                        </div>
                    </li>

                    <!--                    <li class="list-group-item">Vestibulum at eros</li>-->
                </ul>


                <div class="card-body">
                    <a href="{{url('/')}}" class="card-link"><span style="color: #000000;">Created In </span> City Post
                    </a>
                    <!--                    <a href="#" class="card-link">Another link</a>-->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
