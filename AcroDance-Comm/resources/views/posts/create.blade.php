<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-center">新規投稿</h2>
        <form method="POST" action="{{ route('posts.store') }}">
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

            <!-- 活動場所 -->
            <div class="mb-6">
                <label for="location" class="block text-lg font-medium text-gray-700">活動場所</label>
                <select id="location" name="location" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" readonly>
                    <option value="">都道府県を選択</option>
                    @foreach (['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'] as $prefecture)
                        <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                    @endforeach
                </select>
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
</x-app-layout>
