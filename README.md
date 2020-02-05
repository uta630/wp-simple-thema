## Welcome👋
wordpressテンプレ一式を作成  
wordpressで使用するファイルは直下に配置  
静的ページはnpmで管理  

## プラグイン
All in One SEO Pack
|設定(active)|
|:--:|
|XMLサイトマップ|
|ソーシャルメディア|
|Robots.txt|
|悪意あるボットのブロッカー|
|パフォーマンス|
これらを入れてるので`<head>`に設定のないもの有り

## 使い方
一式をwordpressのテーマとして導入して開発
```sh
# 開発環境の監視
npm run watch:all

# 公開ファイルの生成 : distに出力したcss/jsを圧縮してmapを削除
npm run prepare:all
```
