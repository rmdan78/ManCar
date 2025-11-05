<!DOCTYPE html>

<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <meta
            http-equiv="X-UA-Compatible"
            content="ie=edge" />
        <link
            rel="icon"
            href="/images/logo.webp" />
        <title>HMA - Vehicles</title>
        <link
            href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet" />
        <link
            href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
            rel="stylesheet" />
        <script>
            function hideURLbar() {
                window.scrollTo(0, 1);
            }

            addEventListener(
                'load',
                function () {
                    setTimeout(hideURLbar, 0);
                },
                false,
            );
        </script>

        @vite([
            'resources/css/layouts/guest/index.css',
            'resources/js/layouts/guest/index.js',
        ])
        @yield('head')
    </head>
    <body x-data>
        <div
            id="googleTranslateSelect"
            class="position-fixed z-n1 d-none top-0"></div>
        @yield('content')

        <script
            type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({ pageLanguage: 'id' }, 'googleTranslateSelect');
            }

            function removeGoogleTranslateBanner() {
                const intervalID = setInterval(() => {
                    const clickEvnt = new Event('click');
                    const banner = document.getElementById(':1.container');
                    const review = document.getElementById('goog-gt-tt');
                    const loading = document.querySelector('.VIpgJd-ZVi9od-aZ2wEe-wOHMyf');
                    document.body.removeAttribute('style');

                    if (!banner) clearInterval(intervalID);
                    else {
                        banner?.remove();
                        review?.remove();
                        loading?.remove();
                    }
                }, 80);
            }

            window.addEventListener('load', () => {
                removeGoogleTranslateBanner();
            });
        </script>
        @yield('scripts')
        @stack('scripts-stack')
    </body>
</html>
