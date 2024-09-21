<!DOCTYPE html>
<html lang="en">
    <x-drugdept.head title="{{ $title }}" />
    <body class="min-h-screen bg-gray-100 flex flex-col">
        <header>
            <x-drugdept.nav />
        </header>

        <!-- Notification component -->
        <x-drugdept.notification />

        <main class="flex-grow container mx-auto px-4">
            {{ $slot }}
        </main>

        @vite('resources/js/app.js')
        <x-drugdept.footer />

        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>
