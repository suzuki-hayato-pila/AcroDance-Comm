<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">ユーザー登録</h2>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- アカウント名 -->
                <div>
                    <x-input-label for="account_name" :value="__('アカウント名')" />
                    <x-text-input id="account_name" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500" type="text" name="account_name" required autofocus />
                    <x-input-error :messages="$errors->get('account_name')" class="mt-2" />
                </div>

                <!-- メールアドレス -->
                <div>
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500" type="email" name="email" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- パスワード -->
                <div>
                    <x-input-label for="password" :value="__('パスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- パスワード（確認用） -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('パスワード（確認用）')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <!-- Instagram URL -->
                <div>
                    <x-input-label for="instagram" :value="__('Instagram URL')" />
                    <x-text-input id="instagram" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500" type="text" name="instagram" />
                    <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                </div>

                <!-- 性別 -->
                <div>
                    <x-input-label for="gender" :value="__('性別')" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500">
                        <option value="male">男</option>
                        <option value="female">女</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <!-- 写真 -->
                <div>
                    <x-input-label for="profile_photo" :value="__('写真を選択')" />
                    <input id="profile_photo" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500" type="file" name="profile_photo" accept="image/*">
                    <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                </div>

                <!-- 登録ボタン -->
                <div class="flex justify-center">
                    <x-primary-button class="w-full text-center">
                        {{ __('登録') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
