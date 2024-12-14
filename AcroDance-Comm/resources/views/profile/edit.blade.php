{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <div class="flex justify-center items-center h-screen bg-gray-100 overflow-y-auto">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md pb-20 mt-290"> <!-- 余白を追加 -->
            <!-- タイトル -->
            <h2 class="text-center text-2xl font-bold mb-6">プロフィール</h2>

            <!-- プロフィール情報 -->
            <div class="text-center mb-6">
                {{-- <img src="{{ asset('path-to-avatar.png') }}" alt="プロフィール画像" class="w-24 h-24 rounded-full mx-auto mb-4"> --}}
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('path-to-default-avatar.png') }}"
                        alt="プロフィール画像"
                        class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-gray-600">{{ $user->instagram}}</p>
            </div>

            <!-- 編集ボタン -->
            <div class="text-center mb-6">
                <a href="{{ route('profile.edit_bio') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                    編集
                </a>
            </div>

            <!-- 自己紹介 -->
            <div class="bg-gray-100 p-4 rounded-md mb-6">
                <h3 class="text-lg font-semibold">自己紹介</h3>
                <p class="text-gray-600">
                    {{ $user->bio ?: '自己紹介がまだありません。編集ボタンから追加してください。' }}
                </p>
            </div>

            <!-- 投稿一覧 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">投稿一覧</h3>
                <ul class="space-y-2">
                    {{-- <li class="bg-gray-200 p-2 rounded-md">バク転練習メンバー募集</li>
                    <li class="bg-gray-200 p-2 rounded-md">ヒップホップ練習しませんか？</li> --}}
                    @foreach ($posts as $post)
                    <li class="bg-gray-200 p-2 rounded-md">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
                </ul>

                                <!-- ページネーション -->
                                <div class="mt-4">
                                    {{ $posts->links() }}
                                </div>
            </div>
        </div>
    </div>
</x-app-layout>

