<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

// Le decimos que use el layout 'auth' que acabamos de arreglar
new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public bool $showPassword = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: #ffffff; overflow: auto; z-index: 9999;">
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; max-width: 1200px;">
            
            <!-- Left side - Image and Footer -->
            <div style="display: flex; flex-direction: column; justify-content: space-between; padding: 2rem 0;">
                <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 100%; max-width: 450px;">
                        <img src="{{ asset('images/Presentation_1.jpg') }}" alt="Presentation" style="width: 100%; height: auto; object-fit: contain;">
                    </div>
                </div>

                <div style="text-align: left; padding: 0 1rem;">
                    <p style="color: #64748b; font-size: 0.75rem; line-height: 1.5;">
                        © UTESC. Camino al Guasimal S/N. al Noroeste de la Zona Ejidal.<br>
                        C.P 82400. Escuinapa. Sinaloa, México. Teléfono (695) 110 5779
                    </p>
                </div>
            </div>

            <!-- Right side - Login form -->
            <div style="display: flex; align-items: center; justify-content: center;">
                <div class="w-full max-w-md bg-slate-900 rounded-2xl p-8 shadow-2xl">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                            <span class="text-white font-semibold text-lg">Sistema de tutorías</span>
                        </div>
                        <p class="text-teal-400 text-sm mb-6">Universidad Tecnológica de Escuinapa</p>
                        <h1 class="text-2xl font-bold text-white mb-1">¡Bienvenid@ de</h1>
                        <p class="text-teal-400 text-xl font-semibold">nuevo!</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 p-3 bg-teal-500/10 border border-teal-500/20 rounded-lg text-teal-400 text-sm text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="login" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-white text-sm font-medium mb-2">Correo electrónico</label>
                            <input 
                                wire:model="email"
                                type="email" 
                                placeholder="ejemplo@gmail.com"
                                required
                                autofocus
                                autocomplete="email"
                                class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 placeholder-gray-400 transition-all"
                            />
                            @error('email')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-white text-sm font-medium mb-2">Contraseña</label>
                            <div class="relative">
                                <input 
                                    wire:model="password"
                                    type="{{ $showPassword ? 'text' : 'password' }}" 
                                    placeholder="••••••••"
                                    required
                                    autocomplete="current-password"
                                    class="w-full px-4 py-2.5 bg-white text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 placeholder-gray-400 transition-all pr-10"
                                />
                                <button 
                                    type="button"
                                    wire:click="$toggle('showPassword')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                >
                                    @if($showPassword)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    @endif
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between py-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    wire:model="remember"
                                    type="checkbox" 
                                    class="w-4 h-4 accent-teal-500 cursor-pointer rounded border-gray-300"
                                >
                                <span class="text-white text-sm group-hover:text-teal-400 transition-colors">Recordarme</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" wire:navigate class="text-teal-400 text-sm hover:text-teal-300 transition-colors">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <button 
                            type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white font-semibold py-3 rounded-lg transition-all duration-200 mt-6 shadow-lg shadow-teal-600/30"
                        >
                            Iniciar sesión
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-slate-700 text-center">
                        
                </div>
            </div>
        </div>
    </div>

    <!-- Media query para responsive -->
    <style>
        @media (max-width: 1023px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
            div[style*="grid-template-columns: 1fr 1fr"] > div:first-child {
                display: none !important;
            }
        }
    </style>
</div>