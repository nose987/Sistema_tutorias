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

<div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: #f9fafb; overflow: auto; z-index: 9999;">
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; max-width: 1200px;">
            
            <!-- Left side - Illustration and Footer -->
            <div style="display: flex; flex-direction: column; justify-content: space-between; padding: 2rem 0;">
                <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 100%; max-width: 450px;">
                        <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: auto;">
                            <ellipse cx="120" cy="380" rx="40" ry="15" fill="#E2E8F0"/>
                            <path d="M120 350 Q100 370 80 380 Q100 375 120 380" fill="#CBD5E1"/>
                            <path d="M120 350 Q140 370 160 380 Q140 375 120 380" fill="#94A3B8"/>
                            <rect x="200" y="120" width="250" height="200" rx="10" fill="#E2E8F0"/>
                            <rect x="215" y="140" width="100" height="15" rx="5" fill="#CBD5E1"/>
                            <circle cx="330" cy="147" r="7" fill="#CBD5E1"/>
                            <circle cx="350" cy="147" r="7" fill="#CBD5E1"/>
                            <rect x="215" y="170" width="220" height="30" rx="5" fill="white"/>
                            <circle cx="230" cy="185" r="8" fill="#14B8A6"/>
                            <rect x="250" y="178" width="100" height="5" rx="2" fill="#CBD5E1"/>
                            <rect x="250" y="188" width="60" height="4" rx="2" fill="#E2E8F0"/>
                            <rect x="215" y="210" width="220" height="30" rx="5" fill="white"/>
                            <circle cx="230" cy="225" r="8" fill="#14B8A6"/>
                            <rect x="250" y="218" width="100" height="5" rx="2" fill="#CBD5E1"/>
                            <rect x="250" y="228" width="60" height="4" rx="2" fill="#E2E8F0"/>
                            <rect x="215" y="250" width="220" height="30" rx="5" fill="white"/>
                            <circle cx="230" cy="265" r="8" fill="#CBD5E1"/>
                            <rect x="250" y="258" width="100" height="5" rx="2" fill="#CBD5E1"/>
                            <rect x="250" y="268" width="60" height="4" rx="2" fill="#E2E8F0"/>
                            <rect x="330" y="250" width="90" height="60" rx="5" fill="#CBD5E1"/>
                            <path d="M340 285 L350 275 L365 290 L370 285 L410 300 L410 305 L340 305 Z" fill="#94A3B8"/>
                            <circle cx="355" cy="265" r="5" fill="#FCD34D"/>
                            <ellipse cx="480" cy="100" rx="25" ry="35" fill="#A7F3D0" opacity="0.6" transform="rotate(-30 480 100)"/>
                            <ellipse cx="460" cy="140" rx="20" ry="30" fill="#6EE7B7" opacity="0.5" transform="rotate(20 460 140)"/>
                            <ellipse cx="470" cy="200" rx="22" ry="32" fill="#A7F3D0" opacity="0.5" transform="rotate(-15 470 200)"/>
                            <ellipse cx="180" cy="90" rx="20" ry="28" fill="#A7F3D0" opacity="0.6" transform="rotate(25 180 90)"/>
                            <ellipse cx="160" cy="120" rx="18" ry="26" fill="#6EE7B7" opacity="0.5" transform="rotate(-20 160 120)"/>
                            <circle cx="440" cy="160" r="8" fill="#E2E8F0"/>
                            <circle cx="470" cy="250" r="6" fill="#CBD5E1"/>
                            <circle cx="190" cy="130" r="7" fill="#E2E8F0"/>
                            <rect x="480" y="140" width="12" height="30" rx="2" fill="#CBD5E1"/>
                            <rect x="496" y="125" width="12" height="45" rx="2" fill="#CBD5E1"/>
                            <rect x="512" y="135" width="12" height="35" rx="2" fill="#94A3B8"/>
                            <circle cx="280" cy="260" r="18" fill="#8B5CF6"/>
                            <path d="M270 255 Q275 250 280 255 Q285 250 290 255" fill="#4C1D95"/>
                            <path d="M280 278 L265 320 L260 360 L270 360 L275 330 L285 330 L290 360 L300 360 L295 320 Z" fill="#86EFAC"/>
                            <path d="M265 290 L240 300 L235 310 L245 312 L268 302" fill="#86EFAC"/>
                            <path d="M295 290 L315 305 L312 315 L302 312 L290 300" fill="#86EFAC"/>
                            <rect x="305" y="300" width="25" height="35" rx="2" fill="#1E293B"/>
                            <rect x="308" y="303" width="19" height="26" rx="1" fill="#14B8A6" opacity="0.5"/>
                            <rect x="268" y="360" width="10" height="25" fill="#4338CA"/>
                            <rect x="282" y="360" width="10" height="25" fill="#4338CA"/>
                            <ellipse cx="273" cy="387" rx="8" ry="4" fill="#78350F"/>
                            <ellipse cx="287" cy="387" rx="8" ry="4" fill="#78350F"/>
                        </svg>
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
                        <a href="#" class="text-teal-400 text-sm hover:text-teal-300 transition-colors">Aviso de privacidad</a>
                    </div>
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