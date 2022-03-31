{{-- TemplateSample このbladeには複数の親layoutで利用するmetaタグやAnalytics設定などを入れて下さい。--}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

{{-- クローラーが巡回しないようにする設定。ベーシック認証を入れ忘れてリリース前に公開される不幸を回避する。--}}
{{-- 【注意】リリース後検索されたいなら、初回リリースの段階でTagを削除するか、content="all"に変更する。 --}}
<meta name="robots" content="noindex,nofollow">

{{-- セキュリティ対策。同じオリジンにはリファラーが送信されますが、オリジン間リクエストではリファラー情報が送信されません。--}}
<meta name="referrer" content="same-origin">

{{-- XXSセキュリティ対策。scriptや画像など、外部サイト経由でデータを読み込む場合、下記にDmainを追記すること。 --}}
<meta http-equiv="Content-Security-Policy"
      content="default-src 'self' data: ;
               form-action 'self';
               font-src 'self' data: fonts.gstatic.com;
               script-src 'self' 'unsafe-inline';
               style-src 'self' 'unsafe-inline' fonts.googleapis.com;"
>
<meta name="csrf-token" content="{{ csrf_token() }}">


