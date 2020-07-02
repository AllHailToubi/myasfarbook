<div class="tab-pane fade" id="hotel-amenities">
    <h2>Équipements de l'établissement</h2>
    <ul class="amenities clearfix style2">

        @if(empty($facilities))
            No facilities!!!
        @endif

        @foreach ($facilities as $item)
            <li class="col-md-4 col-sm-6">
                <div class="icon-box style2"><i class="{{$item['icon']}} circle"></i>{{$item['title']}} </div>
            </li>
        @endforeach
        
    </ul>
</div>