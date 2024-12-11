<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')

            <!-- 投稿タイトル -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                       class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <!-- 投稿内容 -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold">内容</label>
                <textarea id="content" name="content" rows="4"
                          class="w-full p-2 border border-gray-300 rounded-md">{{ old('content', $post->content) }}</textarea>
            </div>

            <!-- 編集完了ボタン -->
            <div class="text-right">
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    編集完了
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
