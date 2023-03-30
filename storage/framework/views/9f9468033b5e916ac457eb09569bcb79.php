<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Llibreria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="Https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link href="<?php echo e(asset('css/style_login.css')); ?>" rel="stylesheet" type="text/css" />
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

            <form method="post" action="loging">
                <?php echo csrf_field(); ?>
                <h1>Login</h1>
                <hr>
                <label id="email_nombre" for="email">Correo electrónico</label><br>
                <input type="email" id="email" name="email"><br>

                <label for="password">Contraseña</label><br>
                <input type="password" id="password" name="password"><br>

                <button type="submit">Iniciar sesión</button>
            </form>
            <a href="<?php echo e(url('/show')); ?>"><button id="atras">Atras</button></a>

            <?php if($errors->has('general')): ?>
            <p id="error"style="color: red;"><?php echo e($errors->first('general')); ?></p>
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
<?php /**PATH C:\Users\Sergio Gómez\BotigaLlibres\resources\views/login.blade.php ENDPATH**/ ?>