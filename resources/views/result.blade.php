<html>
    <link href="//opgg-static.akamaized.net/css3/common.css?t=1531383300" rel="stylesheet" type="text/css">
    <link href="//opgg-static.akamaized.net/css3/sprite.css?t=1531383300" rel="stylesheet" type="text/css">
    <link href="//opgg-static.akamaized.net/css3/forum.css?t=1531383300" rel="stylesheet" type="text/css">
    <link href="//opgg-static.akamaized.net/css3/new.css?t=1531383300" rel="stylesheet" type="text/css">
    <link href="//opgg-static.akamaized.net/css3/summoner.css?t=1531383300" rel="stylesheet" type="text/css">
    <style>
        .SideContent {
            display: inline-block;
            width: 300px;
            font-size: 12px;
            vertical-align: top;
        }
    </style>
    @foreach( $allData as $info)
    <div class="SideContent">
        <h1>{{ $info['name'] }}</h1>
        {!! $info['rank'] !!}
        {!! $info['content'] !!}
    </div>
    @endforeach
</html>