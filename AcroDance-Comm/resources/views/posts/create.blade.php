<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">

        <!-- デバッグ用にセッションデータを表示（ここを追加） -->
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded-md mb-4">
            <h3 class="font-bold">セッションデバッグ情報</h3>
            {{-- <pre>{{ print_r(session()->all(), true) }}</pre> --}}
            <pre>{{ var_export(session()->all(), true) }}</pre>
        </div>
        <!-- 追加部分ここまで -->


        <h2 class="text-3xl font-bold mb-6 text-center">新規投稿</h2>
        <form method="POST" action="{{ route('posts.store') }}" class="pb-20"> <!-- ここで余白を追加 -->
            @csrf
            <!-- タイトル -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="title" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            </div>

            <!-- 内容 -->
            <div class="mb-6">
                <label for="content" class="block text-lg font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="4" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
            </div>

            {{-- <!-- 活動場所 -->(修正前)
            <div class="mb-6">
                <label for="location" class="block text-lg font-medium text-gray-700">活動場所</label>
                <div id="location-display"
                    class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 px-4 py-2">
                    活動場所が設定されていません
                </div>
                <a href="{{ route('posts.location.create') }}" class="text-blue-600 underline mt-2 block">活動場所を設定する</a>
            </div> --}}

            {{-- <!-- 活動場所 -->（修正後） --}}
            <div class="mb-6">
                <label for="location_name" class="block text-lg font-medium text-gray-700">活動場所</label>
                <div id="location-display"
                    class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 px-4 py-2">
                    {{ session('selectedLocation', '活動場所が設定されていません') }}
                </div>
                <a href="{{ route('posts.location.create') }}" class="text-blue-600 underline mt-2 block">活動場所を設定する</a>
            </div>



            <!-- 希望性別 -->
            <div class="mb-6">
                <label for="preferred_gender" class="block text-lg font-medium text-gray-700">希望性別</label>
                <select id="preferred_gender" name="preferred_gender"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                    <option value="">指定なし</option>
                    <option value="male">男</option>
                    <option value="female">女</option>
                </select>
            </div>

            <!-- 希望人数 -->
            <div class="mb-6">
                <label for="preferred_group_size" class="block text-lg font-medium text-gray-700">希望人数</label>
                <select id="preferred_group_size" name="preferred_group_size"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                    <option value="">指定なし</option>
                    <option value="one">一人</option>
                    <option value="two">二人</option>
                    <option value="three">三人</option>
                </select>
            </div>

            <!-- 投稿ボタン -->
            <div class="text-center">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
                    投稿する
                </button>
            </div>
        </form>
    </div>

    <!-- 修正案を追加 -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const titleInput = document.querySelector('#title');
            const contentInput = document.querySelector('#content');
            const locationDisplay = document.querySelector('#location-display');
            const genderSelect = document.querySelector('#preferred_gender');
            const groupSizeSelect = document.querySelector('#preferred_group_size');

            // 既存データの復元
            const storedTitle = sessionStorage.getItem('postTitle');
            const storedContent = sessionStorage.getItem('postContent');
            const storedLocation = sessionStorage.getItem('selectedLocation');
            const storedGender = sessionStorage.getItem('preferredGender');
            const storedGroupSize = sessionStorage.getItem('preferredGroupSize');

            if (storedTitle) titleInput.value = storedTitle;
            if (storedContent) contentInput.value = storedContent;
            if (storedLocation) locationDisplay.textContent = storedLocation;
            if (storedGender) genderSelect.value = storedGender;
            if (storedGroupSize) groupSizeSelect.value = storedGroupSize;

            // 入力データを保存
            titleInput.addEventListener('input', () => {
                sessionStorage.setItem('postTitle', titleInput.value);
            });
            contentInput.addEventListener('input', () => {
                sessionStorage.setItem('postContent', contentInput.value);
            });
            genderSelect.addEventListener('change', () => {
                sessionStorage.setItem('preferredGender', genderSelect.value);
            });
            groupSizeSelect.addEventListener('change', () => {
                sessionStorage.setItem('preferredGroupSize', groupSizeSelect.value);
            });
        });
    </script>
</x-app-layout>
