<x-app-layout>
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
</x-app-layout>
