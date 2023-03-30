<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="{{ asset('css/mostrar_style.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#menu").menu();
        });
        $(function() {
            $("#selectable").selectable();
        });
        $(document).ready(function() {
            $('#selectable').selectable({
                selected: function(event, ui) {
                    var categoria = $(ui.selected).data('categoria');
                    $('.producto').hide();
                    $('.producto[data-categoria="' + categoria + '"]').show();
                }
            });
        });
    </script>
</head>

<body>
    <div id="header">
        <img src="{{ Storage::url('Imagenes_web/logo.png') }}" alt="Imagen" width="5%">
        <div id="session">
            @if (null !== Session::get('user'))
                <p>Hola, {{ Session::get('user')->nombre }}</p><br>
                <a href="{{ url('logout') }}">Logout</a>
                <a href="{{ route('mostrarCarrito') }}"><img
                        width="10%"src="{{ Storage::url('Imagenes_web/carrito.png') }}"></a>
            @else
                <p><a href="{{ url('login') }}">Login /</a></p>
                <p><a href="{{ url('registro') }}">Registrarse</a></p>
            @endif
        </div>
    </div>
    <input id="tags" placeholder="cercar...">
    <ul id="menu">
        <li>
            <div>Inici</div>
        </li>
        <li>
            <div>Llibres</div>
        </li>
        <li>
            <div>Bloc</div>
        </li>
        <li>
            <div>Llocs</div>
        </li>
        <li>
            <div>Contacte</div>
        </li>
    </ul>
    <div id="menuproductos">
        <a href="{{ url('/show') }}"><button id="atras">Atras</button></a>
        <div id="productos">
            <img src="{{ asset('storage/' . $producto->img) }}" alt="Imagen del producto" width="30%">
            <div class="prod_info">
                <h1 class="titulo_prod">{{ $producto->nombre }}</h1>
                <hr>
                <h2>Descripción:</h2>
                <div id="descripcion">
                    <p class="descrip">{{ $producto->descripcion }}</p>
                </div>
                <div class="subcontenedor">
                    <p class="precio"><b>Precio</b> <i>{{ $producto->precio }}€</i></p>
                    <p class="cate"><b>Categoria</b> <i>{{ $producto->categoria->nombre }}</i></p>
                </div>
                @if (session()->has('mensaje'))
                    <div class="alert alert-success">
                        {{ session('mensaje') }}
                    </div>
                @endif
                @if (session('user') && session('user')->rol == 'user')
                    <form method="POST" action="{{ route('addProduct', ['id' => $producto->id]) }}">
                        @csrf
                        <button class="carrito" type="submit">Añadir al carrito</button>
                    </form>
                @elseif (session('user') && session('user')->rol == 'admin')
                @else
                    <form method="GET" action="{{ url('login') }}">
                        <button class="carrito" type="submit">Añadir al carrito</button>
                    </form>
                @endif
                @if (session('user') && session('user')->rol == 'admin')
                    <form method="GET" action="{{ url('/modify') }}/{{ $producto->id }}">
                        <button class="boton_admin" type="submit">Modificar</button>
                    </form>
                    <form method="GET" action="{{ url('/delete') }}/{{ $producto->id }}">
                        <button class="boton_admin" type="submit">Borrar</button>
                    </form>
                @endif
            </div>
        </div>
        <hr>
        <div id="anadir_valoracion">
            @if (session('user') && session('user')->rol == 'user')
                <h2>Quieres añadir una valoración?</h2>
                <form method="POST" action="{{ route('añadir_valoracion', ['id' => $producto->id]) }}">
                    @csrf
                    <label for="puntuacion">Valoración (1 al 10):</label>
                    <input type="number" name="puntuacion" min="1" max="10" required><br><br>
                    <label id="com" for="comentario">Comentario:</label>
                    <textarea name="comentario" required></textarea><br>
                    <button class="boton_val" type="submit">Agregar valoración</button>
                </form>
            @endif
        </div>
        <hr>
        <h2 id="titulo_valoracion">Valoraciones:</h2>
        @foreach ($valoracion as $v)
            <div id="valoracion">
                <div class="usuario_valor">
                    <p>Comentario por: {{ $v->usuario->nombre }}</p>
                </div>
                <div class="puntuacio">
                    <p>Valoración: <b>{{ $v->puntuacion }}</b>/10</p>
                </div>
                <div class="comentario">
                    <h3>Comentario:</h3>
                    <p>{{ $v->comentario }}</p>
                </div>
            </div>
        @endforeach

    </div>

    <div id="footer">
        <div id="contenedor">
            <img src="{{ Storage::url('Imagenes_web/logo_footer.png') }}" alt="Imagen" width="13%" height="13%">
            <div id="contacte">
                <h3 class="titol_footer">CONTACTE</h3>
                <p>· 93 688 45 99</p>
                <p>· peguinclassics@ibadia.cat</p>
            </div>
            <div id="legal">
                <H3 class="titol_footer">PÀGINES LEGALS</H3>
                <p>· Avís legal</p>
                <p>· Política de Cookies</p>
                <p>· Condicions de venda</p>
                <p>· Protecció de dades</p>
            </div>
            <div id="client">
                <h3 class="titol_footer">ATENCIÓ AL CLIENT</h3>
                <p>· Qui som</p>
            </div>
        </div>
        <div id="iconos">
            <img src="{{ Storage::url('Imagenes_web/face_icon.png') }}" alt="Imagen" width="2%">
            <img src="{{ Storage::url('Imagenes_web/insta_icon.png') }}" alt="Imagen" width="2%">
            <img src="{{ Storage::url('Imagenes_web/twitter_icon.png') }}" alt="Imagen" width="2%">
        </div>
    </div>
</body>

</html>
