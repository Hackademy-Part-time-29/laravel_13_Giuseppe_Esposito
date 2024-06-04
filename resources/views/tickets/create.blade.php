<x-app>

    @if (session()->has('succes'))
        <div class="alert alert-success" role="alert">
            {{session('succes')}}
        </div>
    @endif

    <form method="POST" action="{{route('tickets.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label class="form-label">Oggetto</label>
        <input type="text" class="form-control" name="object" value="{{old('object')}}">
        @error('object')
            <span class="small text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-floating">
        <textarea class="form-control" style="height: 100px" name="description">{{old('description')}}</textarea>
        <label for="floatingTextarea2">Descrizione</label>
        @error('description')
            <span class="small text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Carica uno Screenshoot</label>
        <input class="form-control" type="file" id="formFile" name="image">
        @error('image')
            <span class="small text-danger">{{$message}}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-outline-primary">Invia</button>
    </form>
</x-app>