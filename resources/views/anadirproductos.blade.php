<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="{{ asset('css/anadir_style.css') }}" rel="stylesheet" type="text/css" />
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
                <a href="{{ route('mostrarCarrito') }}"><img width="10%"src="{{ Storage::url('Imagenes_web/carrito.png') }}"></a>
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
            <div id="crear_producto">
                <h2>Crear Producto</h2>
                <form action="{{ url('/addproduct') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="" required>
                    <br>
                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                    <br>
                    <label for="precio">Precio:</label>
                    <input type="text" id="precio" name="precio" pattern="^[0-9]+([,.][0-9]{1,2})?(\s|$)" required>
                    <br>
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="img" name="img" accept="image/*" required>
                    <br>
                    <label for="categoria_id">Categoria:</label>
                    <select id="categoria_id" name="categoria_id" required>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit">Guardar</button>
                </form>
            </div>
            <div id="crear_categoria">
                <h2>Crear Categoria</h2>
                <form action="{{ url('/addCategory') }}" method="GET">
                    <label for="nombre">Nombre:</label>
                    <select name="nombre" id="nombre">
                        <option>tendencia</option>
                        <option>flora-fauna</option>
                        <option>drama</option>
                        <option>infantil</option>
                        <option>art</option>
                        <option>classics</option>
                        <option>fantasia</option>

                    </select>
                    <br>
                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                    <br>
                    <button type="submit">Guardar</button>
                </form>
            </div>
        </div>
        <div id="footer">
            <div id="contenedor">
                <img src="{{ Storage::url('Imagenes_web/logo_footer.png') }}" alt="Imagen" width="13%"
                    height="13%">
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
