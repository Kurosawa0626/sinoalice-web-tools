<!DOCTYPE html>
<html lang="ja" style="background-color: rgb(0, 0, 0);">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=320,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title>SINoALICE Announce Search</title>

    <head prefix="og: http://ogp.me/ns#">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="" />
    <meta property="og:site_name" content="SINoALICE Announce Search" />
    <meta property="og:image" content="{{ url('/') }}/storage/image/announce/ogp/{{ $thumbnail }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@SINoANNOUNCE" />
    <meta name="twitter:image" content="{{ url('/') }}/storage/image/announce/ogp/{{ $thumbnail }}" />
    <meta name="twitter:description" content="" />

    <script src="/storage/js/jquery-2.2.4.min.js"></script>
    <!--    <script>-->
    <!--        var portraitWidth;-->
    <!--        $(window).bind("resize", function(){-->
    <!--            portraitWidth = $(window).width();-->
    <!--            if (portraitWidth) {-->
    <!--                $("html").css("zoom" , portraitWidth/375);-->
    <!--            }-->
    <!--        }).trigger("resize");-->
    <!--    </script>-->
    <link rel="stylesheet" href="/storage/css/pokerabo/reset.css?201806120519">
    <link rel="stylesheet" href="/storage/css/pokerabo/common.css?20210220">
    <link rel="stylesheet" href="/storage/css/pokerabo/announce.css?201806120519">
</head>
<body>
{!! $data !!}
</body>
</html>
