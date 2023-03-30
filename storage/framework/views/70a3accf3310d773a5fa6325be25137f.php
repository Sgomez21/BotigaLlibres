<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="<?php echo e(asset('css/style_registro.css')); ?>" rel="stylesheet" type="text/css" />
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
        <div id="productos">

            <?php if($errors->any()): ?>
                <div>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(url('/registro')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <h1>Registro</h1>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password">Confirmar contraseña:</label>
                <input type="password" id="confirm_password" name="password_confirmation" required>
                <br>
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                    value="<?php echo e(old('fecha_nacimiento')); ?>" required>
                <br>
                <button type="submit">Guardar</button>
            </form>
            <a href="<?php echo e(url('/show')); ?>"><button id="atras">Atras</button></a>
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
<?php /**PATH C:\Users\Sergio Gómez\BotigaLlibres\resources\views/registro.blade.php ENDPATH**/ ?>