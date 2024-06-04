<x-app>

    @if (session()->has('succes'))
        <div class="alert alert-success" role="alert">
            {{session('succes')}}
        </div>
    @endif

    <form method="POST" action="{{route('tickets.update', $ticket)}}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
    <div class="mb-3">
        <label class="form-label">Oggetto</label>
        <input type="text" class="form-control" name="object" value="{{old('object', $ticket->object)}}">
        @error('object')
            <span class="small text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-floating">
        <textarea class="form-control" style="height: 100px" name="description">{{old('description', $ticket->description)}}</textarea>
        <label for="floatingTextarea2">Descrizione</label>
        @error('description')
            <span class="small text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="row">
        <div class="col-3">
            <p>Screenshoot attuale</p>
            <img src="{{Storage::url($ticket->image)}}" class="img-fluid" alt="">
        </div>
        <div class="col-9">
            <div class="mb-3">
                <label for="formFile" class="form-label">Carica uno Screenshoot</label>
                <input class="form-control" type="file" id="formFile" name="image">
                @error('image')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-outline-primary">Modifica</button>
    </form>
</x-app>