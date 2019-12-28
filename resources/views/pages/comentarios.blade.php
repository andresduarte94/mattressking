<br>
<div>
    <h4><strong>Comentarios</strong></h4>
    <hr class="my-2">
    @foreach($data['comentarios'] as $comentario)
        <div class="card mb-2">
                <blockquote class="blockquote text-left ml-3" style="font-size: 1.1em">
                    <div class="mt-1">
                    @foreach($data['user'] as $user)
                        @if($comentario->user_id == $user->id)
                            <strong>{{$user->name}}</strong>
                        @endif
                    @endforeach
                        <img src="/storage/estrellas/{{$comentario->valoracion}}.jpg">
                        <div class="text-right d-inline ml-3"><time>Fecha: {{$comentario->created_at}}</time></div>
                    </div>
                        <hr class="my-1">
                    <p>{{$comentario->comentario}}</p>
                </blockquote>
        </div>
    @endforeach
    {{$data['comentarios']->links()}}
</div>
<br>
<h4><strong>Valora tu compra</strong></h4>
<div class="card">
    <div class="pl-3" style="height: 15em;">
        <form class="comentario" method="post" action="/comentarios">
            <div id="form" class="mt-2">
            <p class="clasificacion">
                <input id="radio1" type="radio" name="valoracion" value="5">
                <label for="radio1">★</label>
                <input id="radio2" type="radio" name="valoracion" value="4">
                <label for="radio2">★</label>
                <input id="radio3" type="radio" name="valoracion" value="3">
                <label for="radio3">★</label>
                <input id="radio4" type="radio" name="valoracion" value="2">
                <label for="radio4">★</label>
                <input id="radio5" type="radio" name="valoracion" value="1">
                <label for="radio5">★</label>
            </p>
            </div>
            <input type="hidden" name='producto' value="{{$data['producto']->id}}">
            <textarea name="comentario" id="comentario" class="form-control mb-3 mt-2" required maxlength="1000" placeholder='Deja tu comentario' style='height: 7em; width: 85%'></textarea>
            <div class="w-75 h-25" style="vertical-align: center">
            <input type="submit" id='comentar' value="Enviar comentario" class="btn btn-primary my-auto">
            <div class="errorTxt d-inline ml-3 my-auto"></div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
