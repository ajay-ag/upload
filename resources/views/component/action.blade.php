<div class="text-center">
    <i class="fas fa-ellipsis-h f-22" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false"></i>
    <div class="dropdown-menu dropdown-menu-right">

        @if(isset($edit))
            <a class="dropdown-item f-14" href="{{ $edit ?? 'javascrip:void(0)' }}">
                <i class="far fa-edit"></i> &nbsp; <span class="">Edit</span>
            </a>
        @endif
        @if(isset($editblank))
            <a style="cursor: default;pointer-events: none; opacity: 0.5;" class="dropdown-item f-14" href="{{ $editblank ?? 'javascrip:void(0)' }}">
                <i class="far fa-edit"></i> &nbsp; <span class="">Edit</span>
            </a>
        @endif


        @if(isset($view))
            <a class="dropdown-item f-14" href="{{ $view ?? 'javascrip:void(0)' }}">
                <i class="far fa-eye"></i> &nbsp; <span class="">View</span>
            </a>
        @endif
       

        @if(isset($view_front))
            <a class="dropdown-item f-14" target="_blank" href="{{ $view_front ?? 'javascrip:void(0)' }}">
                <i class="far fa-eye"></i> &nbsp; <span class="">Ad Preview</span>
            </a>
        @endif

        @if (isset($edit_modal))
            <a class="dropdown-item f-14 call-model"
               data-target-modal="{{ $edit_modal->get('target') }}"
               data-id={{ $edit_modal->get('id') }}
                   data-url="{{ $edit_modal->get('action' , 'javaqscrip:void(0)') }}"
               href="{{ $edit_modal->get('action' , 'javaqscrip:void(0)') }}">
                <i class="far fa-edit "></i> &nbsp; <span class="">Edit</span>
            </a>
        @endif


        @if (isset($status_modal))
            <a class="dropdown-item f-14 call-model"
               data-target-modal="{{ $status_modal->get('target') }}"
               data-id={{ $status_modal->get('id') }}
                   data-url="{{ $status_modal->get('action' , 'javaqscrip:void(0)') }}"
               href="{{ $status_modal->get('action' , 'javaqscrip:void(0)') }}">
                <i class="far fa-edit "></i> &nbsp; <span class="">Change Status</span>
            </a>
        @endif
        @if (isset($status_view_modal))
            <a class="dropdown-item f-14 call-model"
               data-target-modal="{{ $status_view_modal->get('target') }}"
               data-id={{ $status_view_modal->get('id') }}
                   data-url="{{ $status_view_modal->get('action' , 'javaqscrip:void(0)') }}"
               href="{{ $status_view_modal->get('action' , 'javaqscrip:void(0)') }}">
                <i class="far fa-eye "></i> &nbsp; <span class="">View Remark</span>
            </a>
        @endif


        @if (isset($delete))
            <a class="dropdown-item f-14 delete-confrim"
               data-id={{ $delete->get('id') }}  href="{{ $delete->get('action' , 'javaqscrip:void(0)') }}">
                <i class="far fa-trash-alt"></i> &nbsp; <span class="">Delete</span>
            </a>
        @endif
         @if(isset($marksold))
            <a class="dropdown-item f-14"  onclick="return confirm('Are you sure you want to mark as sold?');" href="{{ $marksold ?? 'javascrip:void(0)' }}">
                <i class="far fa-check-circle"></i> &nbsp; <span class="">Mark as Sold</span>
            </a>
        @endif
        @if(isset($markblank))
            <a  style=" cursor: default;pointer-events: none; opacity: 0.5;"  class="dropdown-item f-14"  onclick="return confirm('Are you sure you want to mark as sold?');" href="{{ $markblank ?? 'javascrip:void(0)' }}">
                <i class="far fa-check-circle"></i> &nbsp; <span class="">Mark as Sold</span>
            </a>
        @endif

        @if (isset($view_modal))
            <a class="dropdown-item f-14 call-model"
               data-target-modal="{{ $view_modal->get('target') }}"
               data-id={{ $view_modal->get('id') }}
                   data-url="{{ $view_modal->get('action' , 'javaqscrip:void(0)') }}"
               href="{{ $view_modal->get('action' , 'javaqscrip:void(0)') }}">
                <i class="far fa-eye"></i> &nbsp; <span class="">View</span>
            </a>
        @endif


    </div>

</div>
