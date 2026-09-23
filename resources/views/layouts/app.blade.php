<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('brand.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              gold: {
                50: '#fbf6e9', 100: '#f5e9c6', 200: '#eed89a', 300: '#e3c467',
                400: '#d4af37', 500: '#bd9530', 600: '#9c7a26', 700: '#7a5f1e',
                800: '#5a4516', 900: '#3d2e0f',
              },
              ink: { 900: '#0b0b0c', 800: '#141416', 700: '#1d1d20' }
            },
            fontFamily: {
              serif: ['"Playfair Display"', 'serif'],
              sans: ['"Inter"', 'sans-serif'],
            },
            boxShadow: { luxe: '0 10px 40px -10px rgba(212,175,55,0.35)' }
          }
        }
      }
    </script>
    <style type="text/tailwindcss">
      @layer base {
        html { scroll-behavior: smooth; }
        body { @apply bg-white text-ink-900 font-sans antialiased; }
        h1,h2,h3,h4 { @apply font-serif; }
      }
      @layer components {
        .btn-gold { @apply inline-flex items-center justify-center px-6 py-3 rounded-full bg-gradient-to-r from-gold-400 to-gold-500 text-white font-medium tracking-wide shadow-luxe hover:from-gold-500 hover:to-gold-600 transition; }
        .btn-outline { @apply inline-flex items-center justify-center px-6 py-3 rounded-full border border-gold-400 text-gold-500 font-medium tracking-wide hover:bg-gold-400 hover:text-white transition; }
        .section-title { @apply text-3xl md:text-4xl font-serif font-semibold text-ink-900 mb-2; }
        .section-subtitle { @apply text-gold-500 uppercase tracking-[0.2em] text-xs font-semibold mb-3; }
        .card { @apply bg-white rounded-2xl shadow-sm border border-gold-100 hover:shadow-luxe transition overflow-hidden; }
      }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white">
    <x-navbar />
    <main>
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
