<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>黒澤㌠のSINoALICEうぇっぶつーる置き場</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="stylesheet" href="/storage/css/reset.css?202101212244">
        <link rel="stylesheet" href="/storage/css/top.css?202101212244">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script
    </head>
    <body>
        <header>
            <div class="header-top">
                黒澤㌠のSINoALICEうぇっぶつーる置き場
            </div>
        </header>

        <div class="block-content">
            <a href="/recruit" class="crokuro-top-btn" style="display: block; width: 80%; margin: 10px auto; line-height: 40px; font-size: large;">SINoALICE Member Search</a>
            SINoALICEでギルドやメンバーの募集ツイートを検索しやすくしてるサイトです。<br>
            Twitterのハッシュタグ「#シノアリスギルド募集」と「#シノアリスギルメン募集」だけ拾ってきています。
        </div>

        <div class="block-content">
            <a href="/announce" class="crokuro-top-btn" style="display: block; width: 80%; margin: 10px auto; line-height: 40px; font-size: large;">SINoALICE Announce Search</a>
            お知らせ検索機能（β版）<br>
            お知らせ内リンクが現状効いてません。<br>
            一部画像が出ないのは仕様です。<br>
        </div>

        <img src="{{ asset('storage/image/EsAniDxXAAMvU0Q.jpg') }}" style="width: 100%;">
        <div class="block-content">
            黒澤(<a style="text-decoration: underline; color:#fff;" href="https://twitter.com/kurosawa0626/" target="_blank">@kurosawa0626</a>)が1人で気の向くままやってます。<br>
            赤ずきん過激派です、よろしくお願いします。<br>
            サイトに関する要望などあれば可能な範囲で対応します。
        </div>
    </body>
</html>
