<x-app>
    <br>
    <h3>Crea un nuovo articolo</h3>

    <div class="row">
        @if (session()->has('succes'))
        <div class="alert alert-success" role="alert">
            {{session('succes')}}
        </div>
        @endif

        <!-- @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
        @endif -->
        <div class="col-12">
            <form method="POST" action="{{route('articles.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                    name="name"
                    value="{{old('name')}}"
                    placeholder="Inserisci il titolo">
                @error('name')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control @error('description') is-invalid @enderror" style="height: 100px" name="description">{{old('description')}}</textarea>
                    <label for="floatingTextarea2">Contenuto</label>
                @error('description')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <select class="form-select mb-3 @error('author_id') is-invalid @enderror" aria-label="Default select example" name="author_id">
                    <option selected>Scegli l'autore</option>
                    @foreach($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                <div class="mb-3">
                    <label for="formFile mb-3" class="form-label">Carica un'immagine di copertina</label>
                    <input class="form-control" type="file" id="formFile" name="cover">
                @error('cover')
                    <span class="small text-danger">{{$message}}</span>
                @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
        </div>
    </div>

</x-app>