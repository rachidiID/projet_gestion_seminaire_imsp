<button {{ $attributes->merge(['class' => 'bg-sky-blue-500 hover:bg-sky-blue-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-blue-500 transition-colors']) }}>
    {{ $slot }}
</button>