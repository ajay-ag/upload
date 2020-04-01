 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $page_title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
               @if (isset($add_modal))            
            <div class="float-right">

            <button class="btn btn-primary call-model" 
            data-target-modal="{{ $add_modal->get('target') }}" 
            data-url="{{ $add_modal->get('action' , 'javaqscrip:void(0)') }}"
            href="{{ $add_modal->get('action' , 'javaqscrip:void(0)') }}">
                <i class="fas fa-plus"></i>
                
                {{ $add_modal->get('btn_name' ,'' ) }}
              
            </button> 
          </div>
             @endif
             @if (isset($action))  
             <div class="float-right">
               <a href="{{ $action }}" class="btn btn-primary" {{ isset($attr) ? str_replace('"',' ', $attr ) : '' }}  >
                        <i class="fas fa-plus"></i> {{ $text  }}
                </a>

            </div>
             @endif
             @if (isset($back))  
             <div class="float-right">
               <a href="{{ $back }}" class="btn btn-block btn-outline-secondary" {{ isset($attr) ? str_replace('"',' ', $attr ) : '' }}  >
                        <i class="fas fa-arrow-circle-left"></i> {{ $text  }}
                </a>

            </div>
             @endif
             
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
