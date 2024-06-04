<x-app>

<div class="row">
    <div class="col12">
        <h1>{{$ticket->object}}</h1>
    </div>
</div>

<div class="row">
    <div class="col12">
        <p>{{$ticket->description}}</p>
    </div>
</div>

<div class="row">
    <div class="col12">
        <img src="{{Storage::url($ticket->image)}}" alt="">
    </div>
</div>
</x-app>