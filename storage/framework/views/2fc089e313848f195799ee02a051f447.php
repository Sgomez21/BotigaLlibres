<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="<?php echo e(asset('css/mostrar_style.css')); ?>" rel="stylesheet" type="text/css" />
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
        <img src="<?php echo e(Storage::url('Imagenes_web/logo.png')); ?>" alt="Imagen" width="5%">
        <div id="session">
            <?php if(null !== Session::get('user')): ?>
                <p>Hola, <?php echo e(Session::get('user')->nombre); ?></p><br>
                <a href="<?php echo e(url('logout')); ?>">Logout</a>
                <a href="<?php echo e(route('mostrarCarrito')); ?>"><img
                        width="10%"src="<?php echo e(Storage::url('Imagenes_web/carrito.png')); ?>"></a>
            <?php else: ?>
                <p><a href="<?php echo e(url('login')); ?>">Login /</a></p>
                <p><a href="<?php echo e(url('registro')); ?>">Registrarse</a></p>
            <?php endif; ?>
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
        <a href="<?php echo e(url('/show')); ?>"><button id="atras">Atras</button></a>
        <div id="productos">
            <img src="<?php echo e(asset('storage/' . $producto->img)); ?>" alt="Imagen del producto" width="30%">
            <div class="prod_info">
                <h1 class="titulo_prod"><?php echo e($producto->nombre); ?></h1>
                <hr>
                <h2>Descripción:</h2>
                <div id="descripcion">
                    <p class="descrip"><?php echo e($producto->descripcion); ?></p>
                </div>
                <div class="subcontenedor">
                    <p class="precio"><b>Precio</b> <i><?php echo e($producto->precio); ?>€</i></p>
                    <p class="cate"><b>Categoria</b> <i><?php echo e($producto->categoria->nombre); ?></i></p>
                </div>
                <?php if(session()->has('mensaje')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('mensaje')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('user') && session('user')->rol == 'user'): ?>
                    <form method="POST" action="<?php echo e(route('addProduct', ['id' => $producto->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="carrito" type="submit">Añadir al carrito</button>
                    </form>
                <?php elseif(session('user') && session('user')->rol == 'admin'): ?>
                <?php else: ?>
                    <form method="GET" action="<?php echo e(url('login')); ?>">
                        <button class="carrito" type="submit">Añadir al carrito</button>
                    </form>
                <?php endif; ?>
                <?php if(session('user') && session('user')->rol == 'admin'): ?>
                    <form method="GET" action="<?php echo e(url('/modify')); ?>/<?php echo e($producto->id); ?>">
                        <button class="boton_admin" type="submit">Modificar</button>
                    </form>
                    <form method="GET" action="<?php echo e(url('/delete')); ?>/<?php echo e($producto->id); ?>">
                        <button class="boton_admin" type="submit">Borrar</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div id="anadir_valoracion">
            <?php if(session('user') && session('user')->rol == 'user'): ?>
                <h2>Quieres añadir una valoración?</h2>
                <form method="POST" action="<?php echo e(route('añadir_valoracion', ['id' => $producto->id])); ?>">
                    <?php echo csrf_field(); ?>
                    <label for="puntuacion">Valoración (1 al 10):</label>
                    <input type="number" name="puntuacion" min="1" max="10" required><br><br>
                    <label id="com" for="comentario">Comentario:</label>
                    <textarea name="comentario" required></textarea><br>
                    <button class="boton_val" type="submit">Agregar valoración</button>
                </form>
            <?php endif; ?>
        </div>
        <hr>
        <h2 id="titulo_valoracion">Valoraciones:</h2>
        <?php $__currentLoopData = $valoracion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="valoracion">
                <div class="usuario_valor">
                    <p>Comentario por: <?php echo e($v->usuario->nombre); ?></p>
                </div>
                <div class="puntuacio">
                    <p>Valoración: <b><?php echo e($v->puntuacion); ?></b>/10</p>
                </div>
                <div class="comentario">
                    <h3>Comentario:</h3>
                    <p><?php echo e($v->comentario); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <div id="footer">
        <div id="contenedor">
            <img src="<?php echo e(Storage::url('Imagenes_web/logo_footer.png')); ?>" alt="Imagen" width="13%" height="13%">
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
            <img src="<?php echo e(Storage::url('Imagenes_web/face_icon.png')); ?>" alt="Imagen" width="2%">
            <img src="<?php echo e(Storage::url('Imagenes_web/insta_icon.png')); ?>" alt="Imagen" width="2%">
            <img src="<?php echo e(Storage::url('Imagenes_web/twitter_icon.png')); ?>" alt="Imagen" width="2%">
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\Users\Sergio Gómez\BotigaLlibres\resources\views/mostrarproductos.blade.php ENDPATH**/ ?>