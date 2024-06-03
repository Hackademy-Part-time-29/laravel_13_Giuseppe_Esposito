<x-app>
    <br>
    <h3>Modifica l'articolo</h3>

    <div class="row">
        @if (session()->has('succes'))
        <div class="alert alert-success" role="alert">
            {{session('succes')}}
        </div>
        @endif

        <div class="col-12">
            <form method="POST" action="{{route('articles.update', $article)}}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="mb-3">
                    <label class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                    name="name"
                    value="{{old('name', $article->name)}}"
                    placeholder="Inserisci il titolo">
                @error('name')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-floating">
                    <textarea class="form-control @error('description') is-invalid @enderror" style="height: 100px" name="description" value="{{old('description', $article->description)}}"></textarea>
                    <label for="floatingTextarea2">Contenuto</label>
                @error('description')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Carica un'immagine di copertina</label>
                    <input class="form-control" type="file" id="formFile" name="cover" value="{{old('description', $article->cover)}}">
                @error('cover')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </form>
        </div>
    </div>

</x-app>