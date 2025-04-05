<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mt-1">
                <x-label for="email" value="Email" class="text-dark fw-semibold" />
                <x-input id="email"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required autofocus autocomplete="username"
                         class="block mt-1 w-full border-0 shadow-sm rounded-md focus:outline-none focus:ring-2 focus:ring-[#6A994E]"
                         style="background-color: #F5F1ED;" />
            </div>

            {{-- Password --}}
            <div class="mt-5">
                <x-label for="password" value="Password" class="text-dark fw-semibold" />
                <x-input id="password"
                         type="password"
                         name="password"
                         required autocomplete="current-password"
                         class="block mt-1 w-full border-0 shadow-sm rounded-md focus:outline-none focus:ring-2 focus:ring-[#6A994E]"
                         style="background-color: #F5F1ED;" />
            </div>

            {{-- Recordarme --}}
            <div class="block mt-5">
                <label for="remember_me" class="flex items-center text-sm text-gray-700">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2">Recordarme</span>
                </label>
            </div>

            {{-- Acciones --}}
            <div class="flex items-center justify-between mt-5">
                @if (Route::has('password.request'))
                    <a class="text-sm text-decoration-none text-muted hover:text-dark" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-button class="ms-4 text-white fw-bold transition-all duration-200 hover:bg-[#58833f]" style="background-color: #6A994E;">
                    Iniciar Sesión
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
