# AcroDance-Comm
下記がアプリのURLになります。
- https://acrodance-comm-wispy-sun-8468.fly.dev
## 概要
AcroDanceCommは、アクロバットやダンスの練習仲間を見つけることができるアプリケーションです。
対象ユーザーは20代～30代前半でアクロバットやダンスを始めようと考えている人です。
自身が社会人になりアクロバットとダンスを始めましたが、レッスン会場の大半は子供向けが多く大人が一人で通う事に対して、ハードルがありました。そんな悩みを解決出来るよう、本アプリで練習仲間を見つけられればと思い作成しました。
## 使用技術
### フロントエンド

- JavaScript
- **Tailwind CSS**
- Google Maps API

### バックエンド

- PHP8.3
- Laravel11.23.5

### その他

- PostgreSQL
- Docker（Laravel Sail）
- Git（Sourcetree）

## 主要機能

- **ユーザー機能**
    - ユーザー登録と削除
    - メールアドレスとパスワードの変更
- **投稿機能**
    - セッションの新規作成と投稿
    - セッションの一覧表示と個別表示
    - セッションの編集と削除
    - 地図機能
        - Google Maps API
- **検索検索**
    - セッションの検索

## **アプリケーションの画面**

以下は、アプリケーションの各画面のスクリーンショットです。
スマホでの使用をメインと考えたレイアウトになっております。
### ホーム画面

<img width="216" alt="Top" src="https://github.com/user-attachments/assets/6b99f93f-7f73-4d8c-bce3-fa38dc3501b6" />

- メインカラーは青を使用し、ダンスやアクロバットのクールなイメージを再現
- サブカラーは白を基調とし、補色であるオレンジをアクセントして使用
- メインメニューは下部に設置。アイコンの付帯と、ホバー時に黄色に変化させる事でUI向上を図った
  
### 新規投稿画面

<img width="217" alt="Create" src="https://github.com/user-attachments/assets/91d04d3d-42bd-4b0e-8998-52b45369fd9c" />

- Google Maps APIを導入し、視覚的に活動場所を表現。

### 投稿一覧画面

<img width="217" alt="Search" src="https://github.com/user-attachments/assets/94ce6490-144b-4cbf-890e-fd484176377d" />

- タイトル画面の横に地図を表示し、サムネイルとしての役割を追加

### 投稿詳細画面

<img width="217" alt="Show" src="https://github.com/user-attachments/assets/58f5bb8d-dd67-4f83-a9bc-923b9d1ccbe8" />

- 投稿者の情報を下部に表示。またInstagramのURLをリンクとして表示し、利用者が連絡を取りやすいような導線を意識

### 投稿編集画面

<img width="217" alt="Edit" src="https://github.com/user-attachments/assets/4bdc7e4d-344e-45b0-ba32-2a81277830df" />

### ER図
<img width="676" alt="スクリーンショット 2024-12-23 16 32 05" src="https://github.com/user-attachments/assets/e5ca904a-3ef0-4fa9-9102-95a1b5c80571" />

## 今後の改善点
- DM機能を検討中です。

### DM機能追加時のER図
<img width="700" alt="スクリーンショット 2024-12-23 16 29 36" src="https://github.com/user-attachments/assets/fec72e5c-456a-41cc-bdc6-8a5ca96d4a74" />

## 作者
- 名前: suzuki-hayatp-pila
- お問い合わせ: https://x.com/pira_dan




