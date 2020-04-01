@extends('admin.layout.app')

@section('title' , $title)

@section('content')

@component('component.heading',[
    'page_title' => 'Setting', 'icon' => 'ik ik-settings' , 'tagline' =>'This is all pages.' ,
]) @endcomponent

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
               <div class="row">
                    <div class="col">
                        @component('component.setting',[
                            'icon' => 'ik ik-settings bg-facebook text-white' ,
                            'tag' => 'This is general' ,
                            'link' => route('admin.settings.index')
                        ])
                        General
                        @endcomponent
                    </div>
                    <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-mail bg-facebook text-white' ,
                            'tag' => 'This is mailsetup' ,
                            'link' => route('admin.mailsetup.edit',['id'=>1])
                        ])
                        Mail Setup
                        @endcomponent

                    </div>
                 {{--    <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-home bg-facebook text-white' ,
                            'tag' => 'This is SEO home page' ,
                            'link' => route('admin.homeseo.create')
                        ])
                        SEO Home
                        @endcomponent

                    </div> --}}

                    <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-align-justify bg-facebook text-white' ,
                            'tag' => 'This is Post Attribute' ,
                            'link' => route('admin.post-attribute.index')
                        ])
                        Post Attribute
                        @endcomponent

                    </div>





               </div>

                <div class="row">

                     <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-circle bg-facebook text-white' ,
                            'tag' => 'This is category' ,
                            'link' => route('admin.category.index')
                        ])
                        Category
                        @endcomponent

                    </div>

                    <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-disc bg-facebook text-white' ,
                            'tag' => 'This is sub category' ,
                            'link' => route('admin.subcategory.index')
                        ])
                        Sub Category
                        @endcomponent

                    </div>

                     <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-disc bg-facebook text-white' ,
                            'tag' => 'This is Brand' ,
                            'link' => route('admin.brand.index')
                        ])
                        Brand
                        @endcomponent

                    </div>



                </div>
               <div class="row">
                   <div class="col">
                            @component('component.setting',[
                            'icon' => 'ik ik-image bg-facebook text-white' ,
                            'tag' => 'This is Home Banner' ,
                            'link' => route('admin.homepagebanners.create')
                        ])
                        Home Banner
                        @endcomponent

                    </div>
                    <div class="col">
                          @component('component.setting',[
                            'icon' => 'ik ik-book bg-facebook text-white' ,
                            'tag' => 'This is Static Page' ,
                            'link' => route('admin.staticpages.index')
                        ])
                        Static Pages
                        @endcomponent
                    </div>
                    <div class="col">
                        @component('component.setting',[
                          'icon' => 'ik ik-book bg-facebook text-white' ,
                          'tag' => 'This is Post Remark' ,
                          'link' => route('admin.post-remark.index')
                      ])
                            Post Remark
                        @endcomponent
                    </div>
               </div>
               <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col"></div>
               </div>
            </div>
        </div>
    </div>
</div>


@endsection
