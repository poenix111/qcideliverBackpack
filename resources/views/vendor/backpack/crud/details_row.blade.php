<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
    <div class="row">
        <div class="col-md-12">
            <b>id: </b>{{$entry['id']}}<br>
            <b>email verificado: </b>
            @if($entry['email_verified_at'] == null)
                No se ha verificado<br> 
            @else 
                {{$entry['email_verified_at']}}<br> 
            @endif
            <b>usuario creado: </b>{{$entry['created_at']}}<br>
            <b>usuario actualizado: </b>{{$entry['updated_at']}}
        </div>
    </div>
</div>