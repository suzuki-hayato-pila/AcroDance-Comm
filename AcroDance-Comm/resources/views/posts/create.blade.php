<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">新規投稿</h2>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="title" required class="block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="4" required class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">活動場所</label>
                <input type="text" id="location" name="location" required class="block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="preferred_gender" class="block text-sm font-medium text-gray-700">希望性別</label>
                <select id="preferred_gender" name="preferred_gender" class="block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">指定なし</option>
                    <option value="male">男</option>
                    <option value="female">女</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="preferred_group_size" class="block text-sm font-medium text-gray-700">希望人数</label>
                <select id="preferred_group_size" name="preferred_group_size" class="block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">指定なし</option>
                    <option value="one">一人</option>
                    <option value="two">二人</option>
                    <option value="three">三人</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">投稿する</button>
        </form>
    </div>
</x-app-layout>
