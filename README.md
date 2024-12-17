# AcroDance-Comm
＊DM機能を検討中です。デプロイはまだしておりませんので、ローカルで動くのみの状態です。
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

- PHP8.3or8.4 
- Laravel11.23.5

### その他

- PostgreSQL←version要確認
- Docker（Laravel Sail）
- Git（Sourcetree）

## 主要機能

---

- **ユーザー機能**
    - ユーザー登録と削除
    - メールアドレスとパスワードの変更
- **投稿機能**
    - セッションの新規作成と投稿
    - セッションの閲覧と個別表示
    - セッションの編集と削除
    - セッションの検索
    - 地図機能
        - Google Maps API

## **アプリケーションの画面**

---

以下は、アプリケーションの各画面のスクリーンショットです。
※デザインは別途修正予定です。
### ホーム画面

<img width="1404" alt="スクリーンショット 2024-12-17 22 48 36" src="https://github.com/user-attachments/assets/4bca8d34-630c-45bb-888f-baeb5853b9d7" />

### 新規投稿画面

<img width="1890" alt="スクリーンショット 2024-12-17 22 51 48" src="https://github.com/user-attachments/assets/c07d73e4-056d-4882-b1b0-3133b7407dcf" />

### 投稿編集画面

<img width="1893" alt="スクリーンショット 2024-12-17 22 54 40" src="https://github.com/user-attachments/assets/6edfcfca-9dc6-4166-9d10-ec9d71fffc35" />

### 投稿検索画面

<img width="1887" alt="スクリーンショット 2024-12-17 22 57 52" src="https://github.com/user-attachments/assets/6c9327cb-94d6-49f1-b3a6-8e5f53dfd976" />

### ER図

<img width="710" alt="スクリーンショット 2024-12-17 23 00 28" src="https://github.com/user-attachments/assets/7b49ecc5-1826-43be-9c13-18a16c856384" />

