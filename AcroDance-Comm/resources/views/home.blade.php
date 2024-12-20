<x-app-layout>
    <div class="bg-blue-100 max-w-7xl mx-auto px-4 py-6">
        <!-- 通知メッセージの表示 -->
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('status') }}
            </div>
        @endif

        <!-- 中段のメイン内容 -->
        <div class="my-6 pb-[100px]">

            <!-- メインキャッチフレーズ -->
            <div class="bg-white p-6 text-center rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-blue-900">ダンスとアクロバットの練習仲間<br>見つけませんか？</h2>
            </div>

            <!-- イラストの追加 -->
            <div class="flex justify-center mt-6">
                <img src="/images/dynamic-portrait-young-man-woman-dancing-hiphop-isolated-black-background-with-mixed-lights-effect.jpg" alt="ダンスとアクロバットのシルエット" class="w-full max-w-md rounded-md shadow-md">
            </div>

            <!-- サイトの使い方 -->
            <div class="bg-white p-6 mt-6 text-center rounded-md">
                <h3 class="text-xl font-bold mb-4 text-blue-900">本サイトの使い方</h3>
                <p class="text-base text-gray-700 mb-6">
                    本サイトは社会人からダンスやアクロバットを始めたい方が、一緒に練習する仲間探しを手助けするサイトです。
                </p>

                <!-- 手順リスト -->
                <div class="space-y-8">
                    <!-- その1 -->
                    <div class="text-center">
                        <img src="/images/9133514_signup_register_login_icon.png" alt="アイコン1" class="w-12 h-12 mx-auto mb-4">
                        <h4 class="text-lg font-semibold mb-2 text-orange-500">その1. ユーザー登録をしてみよう</h4>
                        <p class="text-base text-gray-700">
                            ユーザー登録をすると、練習仲間を募るためのワークショップの「投稿」ができるようになります。
                        </p>
                    </div>

                    <!-- その2 -->
                    <div class="text-center">
                        <img src="/images/6351912_comment_email_mail_message_post_icon.png" alt="アイコン2" class="w-12 h-12 mx-auto mb-4">
                        <h4 class="text-lg font-semibold mb-2 text-orange-500">その2. 投稿をしてみよう</h4>
                        <p class="text-base text-gray-700">
                            活動項目、内容、場所、希望人数、希望性別を入力し、セッションを投稿してみよう。
                        </p>
                    </div>

                    <!-- その3 -->
                    <div class="text-center">
                        <img src="/images/211817_search_strong_icon.png" alt="アイコン3" class="w-12 h-12 mx-auto mb-4">
                        <h4 class="text-lg font-semibold mb-2 text-orange-500">その3. 検索してみよう</h4>
                        <p class="text-base text-gray-700">
                            どんな仲間が練習相手を探しているか、検索してみよう。一緒に練習したいと思った相手にはメッセージを送ってみよう。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
