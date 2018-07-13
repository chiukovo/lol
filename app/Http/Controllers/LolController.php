<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Curl, Request, Ping;

class LolController extends Controller
{
    //version 6.24.1
    const IMGURL = 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img';
    const KEYWORD = '進入組隊房間';

    public function index()
    {
        return view('welcome');
    }

    public function result()
    {
        $target = Request::input('target');
        $data = [];

        if ( ! is_null($target) ) {
            $explode = explode(" ", $target);

            foreach ($explode as $key => $info) {
                if ( $info != self::KEYWORD ) {
                    //確認下一項是進入組隊房間
                    if ( isset($explode[$key + 1]) && $explode[$key + 1] == self::KEYWORD ) {
                        $data[] = $info;
                    }
                }
            }
        }

        $allData = [];

        foreach ($data as $name) {
            //待采集的目标页面
            $page = 'http://tw.op.gg/summoner/userName=' . $name;

            //列表选择器
            $list = '.SummonerLayoutWrap';

            $header = [
                'headers' => [
                    'Cookie' => 'customLocale=zh_TW'
                ]
            ];
            //采集规则
            $main = array(
                //content
                'name' => ['.SummonerLayoutWrap .Profile .Name', 'text'],
                'rank' => ['.SummonerLayoutWrap .tierRank', 'text'],
                'win' => ['.SummonerLayoutWrap .TierInfo .WinLose .wins', 'text'],
                'losses' => ['.SummonerLayoutWrap .TierInfo .WinLose .losses', 'text'],
                'winRatio' => ['.SummonerLayoutWrap .TierInfo .WinLose .winratio', 'text'],
                'img' => ['.SummonerLayoutWrap .Face .ProfileIcon .ProfileImage', 'src'],
            );

            $details = array(
                'title' => ['.SummonerLayoutWrap .ChampionWinRatioBox .Face i', 'title'],
                'url' => ['.SummonerLayoutWrap .ChampionWinRatioBox .Face a', 'href'],
                'winRatio' => ['.SummonerLayoutWrap .ChampionWinRatioBox .WinRatio', 'text'],
                'graphWin' => ['.SummonerLayoutWrap .ChampionWinRatioBox .RatioGraph .Graph .Text.Left', 'text'],
                'graphLoss' => ['.SummonerLayoutWrap .ChampionWinRatioBox .RatioGraph .Graph .Text.Right', 'text'],
            );

            $history = array(
                'kill' => ['.GameItemList .GameItemWrap .Content .KDA .KDA .Kill', 'text'],
                'die' => ['.GameItemList .GameItemWrap .Content .KDA .KDA .Death', 'text'],
                'assist' => ['.GameItemList .GameItemWrap .Content .KDA .KDA .Assist', 'text'],
            );

            $result = \QL\QueryList::get($page, '', $header);

            $mainData = $result->rules($main)->query()->getData()->all();
            $detailData = $result->rules($details)->query()->getData()->all();
            $historyData = $result->rules($history)->query()->getData()->all();

            $thisData = [
                'info' => isset($mainData[0]) ? $mainData[0] : [],
                'sevendays' => $detailData,
                'history' => $historyData,
            ];

            $allData[] = self::formatData($thisData);
        }

        return view('result', [
            'allData' => $allData
        ]);
    }

    public function formatData($allData)
    {
        if ( ! empty($allData['info']) && isset($allData['info']['img']) ) {
            $img = str_replace('//opgg-static.akamaized.net/images/profile_icons/profileIcon', "", $allData['info']['img']);
            $img = str_replace('.jpg', ".png", $img);
            $allData['info']['img'] = 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/profileicon/' . $img;

            $ping = Ping::check($allData['info']['img']);

            if ( $ping != '200' ) {
                $allData['info']['img'] = '/image/noimage.png';
            }
        }

        if ( ! empty($allData['sevendays']) ) {
            foreach ($allData['sevendays'] as $key => $info) {
                if ( isset($info['url']) ) {
                    $name = str_replace('/statistics', "", $info['url']);
                    $name = str_replace('/champion/', "", $name);
                    $allData['sevendays'][$key]['url'] = 'http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/' . ucfirst($name) . '.png';
                }
            }
        }

        return $allData;
    }
}