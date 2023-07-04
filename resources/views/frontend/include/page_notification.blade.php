@push('js')


<script>
var option = {"positionClass": "toast-top-right","timeOut": "10000"};    
$(document).ready(function(){ 
    @if (Session::has('flash_message'))
        toastr.info('Action Success!',"{{ Session::get('flash_message') }}",option);
    @endif

    @if (Session::has('flash_warning'))
        toastr.warning('Action Not Procede!',"{{ Session::get('flash_warning') }}",option);
    @endif

    @if (Session::has('flash_error'))
        toastr.error('Action Not Procede!',"{{ Session::get('flash_error') }}",option);
    @endif

    @if (Session::has('flash_success'))
        toastr.success('Action Success!',"{{ Session::get('flash_success') }}",option);
    @endif
});
    
</script>
@endpush