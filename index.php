<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión universal | tumedic</title>
    <?php
    include 'includes/headConf.php';
    include 'settings/conn.php';
    ?>

</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-14 mr-2" src="src/img/tumedic-logo.png" alt="tumedic logo">
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Inicio de sesión universal
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="login.php" method="post" onsubmit="return validateForm(event)">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección de correo electrónico</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nombre@empresa.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="curp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CURP</label>
                            <input type="text" name="curp" id="curp" placeholder="ABCD123456GES1A2B" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <!-- <div class="flex items-center justify-between"> -->
                        <!-- <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">¿Olvidó su contraseña?</a> -->
                        <!-- </div> -->

                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Iniciar sesión</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Tras acceder con éxito, será redirigido hacia su portal designado. </p>
                        <div id="error"></div>
                        <script>
                            function validateForm(event) {
                                event.preventDefault();
                                var formData = new FormData(event.target);

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'login.php', true);
                                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            var response = JSON.parse(xhr.responseText);

                                            var errorElement = document.getElementById('error');

                                            errorElement.innerText = response.errors && response.errors.login || '';

                                            if (response.errors && response.errors.login) {
                                                errorElement.classList.add('bg-red-500', 'pt-2', 'pb-2', 'text-center', 'font-bold', 'text-white', 'rounded-xl');
                                            } else {
                                                errorElement.classList.remove('bg-red-500', 'pt-2', 'pb-2', 'text-center', 'font-bold', 'text-white', 'rounded-xl');

                                                if (response.success && response.redirect_url) {
                                                    window.location.href = response.redirect_url;
                                                }
                                            }
                                        }
                                    }
                                };

                                xhr.send(formData);

                                return false;
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>


</html>