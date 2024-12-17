<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">ログイン</h2>

            {{-- <!-- Instagram Login Button -->
            <div class="mb-6">
                <a href="#" class="block w-full text-center bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                    インスタグラムで登録・ログイン
                </a>
            </div> --}}
{{--
            <!-- Google Login Button -->
            <div class="mb-6">
                <a href="{{ route('google.redirect') }}" class="block w-full text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                    Googleで登録・ログイン
                </a>
            </div> --}}

            {{-- <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="border-t w-full"></div>
                <span class="mx-4 text-gray-500 text-sm">もしくは</span>
                <div class="border-t w-full"></div>
            </div> --}}

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('パスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">このブラウザに認証情報を記憶</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <x-primary-button class="w-full text-center">
                        ログイン
                    </x-primary-button>
                </div>
            </form>

            <!-- Links -->
            <div class="mt-6 text-center space-y-2">
                <a href="{{ route('register') }}" class="block text-sm text-gray-500 hover:underline">
                    ユーザー登録はこちら
                </a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="block text-sm text-gray-500 hover:underline">
                        パスワードを忘れた方はこちら
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
