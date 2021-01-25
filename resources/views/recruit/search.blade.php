<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>SINoALICE Member Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/strage/css/reset.css?201806120519">
    <link rel="stylesheet" href="/storage/css/recruit.css?202007271716">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $(function()
        {
            $(".btn-search").on("click", function(){
                $(".search-layer").css("visibility", "visible");
            });
            $(".btn-close").on("click", function(){
                $(".search-layer").css("visibility", "hidden");
            });
        });
    </script>
</head>
<body>
<header>
    <div class="header-top">
        <a href="/recruit" style="color: #fff;">SINoALICE Member Search</a>
        <span style="margin: 0 5px;">&gt;</span>
        {{ $type == "guild" ? "ギルド" : "ギルメン" }}募集ツイート
    </div>
</header>
<div style="margin: 0 8px 8px 8px;">
    <div style="text-align: right;">検索結果：<span style="">{{ $tweets->total() }}件</span>
        @foreach ($tweets as $tweet)
        {!! $tweet->html !!}
        @endforeach
        <div style="display: flex; justify-content: center;">
            <a class="btn-small" href="{{ $tweets->appends(['colosseum' => $params['colosseum'], 'job' => $params['job'], 'free_text' => $params['free_text']])->previousPageUrl() }}">Prev</a>
            <a class="btn-small" href="{{ $tweets->appends(['colosseum' => $params['colosseum'], 'job' => $params['job'], 'free_text' => $params['free_text']])->nextPageUrl() }}">Next</a>
        </div>

        <p class="btn-search">
            <span style="line-height: 50px;" class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </p>
    </div>

    <div class="search-layer">
        <form class="search-form" method="get" name="search" action="/recruit/search/{{ $type }}" style="width: 100%;">
            <div style="width: 90%; max-width: 516px; margin: 0 auto 50px;">
                コロシアムの時間帯<br />
                <select class="form-control" name="colosseum" style="margin-bottom: 10px;">
                    <option value="">時間帯</option>
                    <option value="08" @if ($params['colosseum']=="08") selected @endif>08:00</option>
                    <option value="12" @if ($params['colosseum']=="12") selected @endif>12:30</option>
                    <option value="18" @if ($params['colosseum']=="18") selected @endif>18:00</option>
                    <option value="19" @if ($params['colosseum']=="19") selected @endif>19:00</option>
                    <option value="20" @if ($params['colosseum']=="20") selected @endif>20:00</option>
                    <option value="21" @if ($params['colosseum']=="21") selected @endif>21:00</option>
                    <option value="22" @if ($params['colosseum']=="22") selected @endif>22:00</option>
                    <option value="23" @if ($params['colosseum']=="23") selected @endif>23:00</option>
                </select>

                募集ジョブ<br />
                <select class="form-control" name="job" style="margin-bottom: 10px;">
                    <option value="">募集ジョブ</option>
                    <option value="attacker" @if ($params['job']=="attacker") selected @endif >前衛</option>
                    <option value="minstrel" @if ($params['job']=="minstrel") selected @endif >ミンストレル</option>
                    <option value="sorcerer" @if ($params['job']=="sorcerer") selected @endif >ソーサラー</option>
                    <option value="cleric"   @if ($params['job']=="cleric")   selected @endif >クレリック</option>
                </select>

                ツイート本文検索（スペースでAND検索）<br>
                <input class="form-control" name="free_text" style="margin-bottom: 10px;" value="{{ $params['free_text'] }}" placeholder="本文検索（スペースでAND検索）" />

                <div style="display: flex; justify-content: center;">
                    <a class="btn-small" href="javascript:search.submit()">検索する</a>
                    <a class="btn-small btn-close">やめる</a>
                </div>
            </div>

        </form>

    </div>

</body>
</html>
