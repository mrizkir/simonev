<div class="row">
    <div class="col-md-12">
        @if (count($errors) > 0)    
            @foreach ($errors->all() as $error)                
                <div class="alert alert-danger no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Error!</span> {{$error}}
                </div>
            @endforeach
        @endif
        
        @if (session('success'))
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Sucess!</span> {{session('success')}}
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Error!</span> {{session('error')}}
            </div>
        @endif
        
        @if (session('warning'))
            <div class="alert alert-warning no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Error!</span> {{session('error')}}
            </div>
        @endif        
    </div>
</div>
