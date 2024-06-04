<x-app>

<h1>Lista dei ticket</h1>

@if(session()->has('succes'))
    <div class="alert alert-success" role="alert">
        {{session('succes')}}
    </div>
@endif

<table class="table">
  <thead class="table-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Oggetto</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tickets as $ticket)
        <tr>
            <th scope="row">{{$ticket->id}}</th>
            <td>{{$ticket->object}}</td>
            <td>{{Str::limit($ticket->description, 25)}}</td>
            <td>
                <a href="{{route('tickets.show', $ticket)}}" class="btn btn-outline-success">Mostra</a>
                <a href="{{route('tickets.edit', $ticket)}}" class="btn btn-outline-primary">Modifica</a>
                <form method="POST" action="{{route('tickets.destroy', $ticket)}}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-outline-danger" onclick="alert('Sei sicuro di voler eliminare il ticket?')">Elimina</button>
                </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

</x-app>