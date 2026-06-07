<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Blog Kami - Halaman Utama Pengunjung')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style data-purpose="custom-fonts">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy-dark': '#2A3645',
                        'bg-light': '#F8FAFC',
                        'text-gray': '#4A5568',
                        'tag-bg': '#EBF4FF',
                        'tag-text': '#3182CE',
                        'btn-green': '#38A169',
                        'btn-green-hover': '#2F855A',
                        'sidebar-active-bg': '#C6F6D5',
                        'sidebar-active-text': '#22543D',
                        'badge-bg': '#E2E8F0',
                        'badge-text': '#4A5568',
                        'badge-active-bg': '#38A169',
                        'badge-active-text': '#FFFFFF',
                        'brand-dark': '#2d3e50',
                        'brand-bg': '#f7fafc',
                        'brand-text': '#4a5568',
                        'brand-blue': '#4299e1',
                        'brand-blue-light': '#ebf8ff',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bg-light text-gray-800 antialiased flex flex-col min-h-screen">
    <!-- HeaderSection -->
    <header class="bg-navy-dark text-white py-6">
        <div class="container mx-auto px-4 max-w-6xl flex justify-between items-center">
            <!-- Logo and Subtitle -->
            <div>
                <h1 class="text-2xl font-bold mb-1"><a href="{{ route('public.index') }}">Blog Kami</a></h1>
                <p class="text-sm text-gray-300">Artikel terbaru seputar teknologi dan pemrograman</p>
            </div>
            <!-- Navigation Menu -->
            <nav>
                <ul class="flex space-x-6 text-sm font-medium text-gray-300">
                    <li><a class="hover:text-white transition-colors {{ request()->routeIs('public.index') ? 'text-white' : '' }}" href="{{ route('public.index') }}">Beranda</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('public.index') }}">Artikel</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('login') }}">Login CMS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="flex-grow">
        @yield('content')
    </div>

    <!-- FooterSection -->
    <footer class="bg-navy-dark text-white py-6 mt-12">
        <div class="container mx-auto px-4 max-w-6xl text-center text-xs text-gray-400">
            <p>&copy; {{ date('Y') }} Blog Kami. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>
</body>
</html>
