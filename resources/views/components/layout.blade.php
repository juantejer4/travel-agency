<!doctype html>

<title>Travel agency</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-12 py-8">
        <nav class="md:flex md:justify-between md:items-center pb-4">
            <div>
                <a href="/">
                    <svg width="100" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#76b2d0" stroke="#76b2d0"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;stroke:#57a5d6;stroke-miterlimit:10;stroke-width:1.91px;}</style></defs><path class="cls-1" d="M22.5,5.32V18.68H11.05a1.91,1.91,0,0,0-3.82,0H1.5V5.32H7.23a1.91,1.91,0,0,0,3.82,0Z"></path><line class="cls-1" x1="15.82" y1="7.23" x2="15.82" y2="14.86"></line><line class="cls-1" x1="13.91" y1="15.82" x2="15.82" y2="14.86"></line><line class="cls-1" x1="17.73" y1="15.82" x2="15.82" y2="14.86"></line><line class="cls-1" x1="15.82" y1="10.09" x2="12" y2="12"></line><line class="cls-1" x1="15.82" y1="10.09" x2="19.64" y2="12"></line><line class="cls-1" x1="8.18" y1="10.09" x2="10.09" y2="10.09"></line><line class="cls-1" x1="8.18" y1="13.91" x2="10.09" y2="13.91"></line></g></svg>
                </a>
            </div>

        </nav>

        {{ $slot }}
        
    </section>

</body>