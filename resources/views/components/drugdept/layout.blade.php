<!DOCTYPE html>
<html lang="en">
    <x-drugdept.head title="{{ $title }}" />
    <body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <header>
            <x-drugdept.nav />
        </header>

        <!-- Notification component -->
        <x-drugdept.notification />

        <main class="container flex-grow px-4 mx-auto">
            {{ $slot }}
        </main>

        @vite('resources/js/app.js')
        <x-drugdept.footer />

        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>
