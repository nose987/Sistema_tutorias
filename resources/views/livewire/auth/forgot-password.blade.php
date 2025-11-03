<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('Se enviará un enlace de restablecimiento si la cuenta existe.'));
    }
}; ?>

<div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: #ffffff; overflow: auto; z-index: 9999;">
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; max-width: 1200px;">
            
            <!-- Left side - Image -->
            <div style="display: flex; flex-direction: column; justify-content: space-between; padding: 2rem 0;">
                <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 100%; max-width: 450px;">
                        <img src="{{ asset('images/cerdito.jpg') }}" alt="Cerdito" style="width: 100%; height: auto; object-fit: contain;">
                    </div>
                </div>

                <div style="text-align: left; padding: 0 1rem;">
                    <p style="color: #64748b; font-size: 0.75rem; line-height: 1.5;">
                        © UTESC. Camino al Guasimal S/N. al Noroeste de la Zona Ejidal.<br>
                        C.P 82400. Escuinapa. Sinaloa, México. Teléfono (695) 110 5779
                    </p>
                </div>
            </div>

            <!-- Right side - Form -->
            <div style="display: flex; align-items: center; justify-content: center;">
                <div class="w-full max-w-md bg-slate-900 rounded-2xl p-8 shadow-2xl">
                    <!-- Logo and Header -->
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <span class="text-white font-semibold text-lg">Sistema de tutorías</span>
                        </div>
                        <p class="text-teal-400 text-sm mb-6">Universidad Tecnológica de Escuinapa</p>
                        <h1 class="text-2xl font-bold text-white mb-2">¿Olvidaste tu</h1>
                        <p class="text-teal-400 text-xl font-semibold mb-3">contraseña?</p>
                        <p class="text-slate-400 text-sm">
                            No te preocupes, te enviaremos un enlace para restablecerla
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-6 p-4 bg-teal-500/10 border border-teal-500/30 rounded-lg text-teal-400 text-sm text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form wire:submit="sendPasswordResetLink" method="POST" class="space-y-6">
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

                        <button 
                            type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-lg shadow-teal-600/30 flex items-center justify-center gap-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            Enviar enlace de recuperación
                        </button>
                    </form>

                    <!-- Back to login -->
                    <div class="mt-8 pt-6 border-t border-slate-700 text-center">
                        <span class="text-slate-400 text-sm">¿Recordaste tu contraseña? </span>
                        <a href="{{ route('login') }}" wire:navigate class="text-teal-400 text-sm hover:text-teal-300 transition-colors font-medium">
                            Iniciar sesión
                        </a>
                    </div>

                    <!-- Privacy -->
                    <div class="mt-4 text-center">
                       
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