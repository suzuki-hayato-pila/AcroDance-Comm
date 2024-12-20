{{-- <x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">自己紹介を編集</h2>

            <form method="POST" action="{{ route('profile.update_bio') }}">
                @csrf
                @method('PATCH') <!-- HTTPメソッドとしてPATCHを明示 -->

                <div class="mb-4">
                    <textarea
                        name="bio"
                        rows="5"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="自己紹介を入力してください"
                    >{{ old('bio', $user->bio) }}</textarea> <!-- bioの初期値を設定 -->
                    @error('bio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700"
                    >
                        保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-blue-100">
        <div class="w-full max-w-md bg-gray-100 p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">プロフィールを編集</h2>

            <form method="POST" action="{{ route('profile.update_bio') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- プロフィール画像 -->
                <div class="mb-4">
                    <label for="profile_photo" class="block text-sm font-medium text-gray-800">プロフィール画像</label>
                    <input type="file" id="profile_photo" name="profile_photo" class="block w-full border-gray-300 rounded-md shadow-sm">
                    @error('profile_photo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 名前 -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-800">名前</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm"
                    >
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- メールアドレス -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-800">メールアドレス</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm"
                    >
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instagram URL -->
                <div class="mb-4">
                    <label for="instagram" class="block text-sm font-medium text-gray-600">Instagram URL</label>
                    <input
                        type="text"
                        id="instagram"
                        name="instagram"
                        value="{{ old('instagram', $user->instagram) }}"
                        class="block w-full border-gray-300 rounded-md shadow-sm"
                    >
                    @error('instagram')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 自己紹介 -->
                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-800">自己紹介</label>
                    <textarea
                        id="bio"
                        name="bio"
                        rows="5"
                        class="block w-full border-gray-300 rounded-md shadow-sm"
                    >{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 保存ボタン -->
                <div class="text-center">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700"
                    >
                        保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
