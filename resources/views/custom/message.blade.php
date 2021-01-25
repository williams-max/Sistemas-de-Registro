
 @if (session('status_success'))
 <div class="alert alert-success" role="alert">
       {{ session('status_success')}}

 </div>
@endif

@if (session('status'))
 <div class="alert alert-success" role="alert">
       {{ session('status')}}

 </div>
@endif

@if (session('status2'))
 <div class="alert alert-success" role="alert">
       {{ session('status2')}}

 </div>
@endif
