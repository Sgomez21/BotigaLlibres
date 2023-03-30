<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="<?php echo e(asset('css/carrito_style.css')); ?>" rel="stylesheet" type="text/css" />
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
            <h1 id="titulo_carrito">Carrito de compra</h1>
            <?php if(count($productos) > 0): ?>
                <div class="compras">
                    <ul>
                        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carrito_producto">
                                <li>
                                    <?php if($producto->producto): ?>
                                        <img src="<?php echo e(Storage::url($producto->producto->img)); ?>" width="20%">
                                        <?php echo e($producto->producto->nombre); ?> - Cantidad: <?php echo e($producto->cantidad); ?> <a
                                            href="<?php echo e(url('/delete_carrito')); ?>/<?php echo e($producto->id); ?>"> X </a>
                                    <?php endif; ?>
                                </li>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php else: ?>
                <p>No hay productos en el carrito</p>
            <?php endif; ?>
        </div>
        <div id="footer">
            <div id="contenedor">
                <img src="<?php echo e(Storage::url('Imagenes_web/logo_footer.png')); ?>" alt="Imagen" width="13%"
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
                <img src="<?php echo e(Storage::url('Imagenes_web/face_icon.png')); ?>" alt="Imagen" width="2%">
                <img src="<?php echo e(Storage::url('Imagenes_web/insta_icon.png')); ?>" alt="Imagen" width="2%">
                <img src="<?php echo e(Storage::url('Imagenes_web/twitter_icon.png')); ?>" alt="Imagen" width="2%">
            </div>
        </div>
</body>

</html>
<?php /**PATH C:\Users\Sergio Gómez\BotigaLlibres\resources\views/carrito.blade.php ENDPATH**/ ?>