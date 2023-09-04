<!DOCTYPE html>
<html>

<head>
    <title>Travel agency</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-12 py-8">
        <nav class="flex items-center justify-between pb-4">
            <svg width="100" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#76b2d0" stroke="#76b2d0">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: none;
                                stroke: #57a5d6;
                                stroke-miterlimit: 10;
                                stroke-width: 1.91px;
                            }
                        </style>
                    </defs>
                    <path class="cls-1" d="M22.5,5.32V18.68H11.05a1.91,1.91,0,0,0-3.82,0H1.5V5.32H7.23a1.91,1.91,0,0,0,3.82,0Z"></path>
                    <line class="cls-1" x1="15.82" y1="7.23" x2="15.82" y2="14.86"></line>
                    <line class="cls-1" x1="13.91" y1="15.82" x2="15.82" y2="14.86"></line>
                    <line class="cls-1" x1="17.73" y1="15.82" x2="15.82" y2="14.86"></line>
                    <line class="cls-1" x1="15.82" y1="10.09" x2="12" y2="12"></line>
                    <line class="cls-1" x1="15.82" y1="10.09" x2="19.64" y2="12"></line>
                    <line class="cls-1" x1="8.18" y1="10.09" x2="10.09" y2="10.09"></line>
                    <line class="cls-1" x1="8.18" y1="13.91" x2="10.09" y2="13.91"></line>
                </g>
            </svg>
            <div class="flex px-24 text-xl uppercase opacity-60">
                <a href="cities" class="hover:text-gray-400 px-12">Cities</a>
                <a href="airlines" class="hover:text-gray-400 px-12">Airlines</a>
                <a href="flights" class="hover:text-gray-400 px-12">Flights</a>
            </div>
        </nav>

        {{ $slot }}

    </section>

    <script src="/navbar.js"></script>
</body>

</html>