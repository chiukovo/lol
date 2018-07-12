<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Curl, Request;

class EggController extends Controller
{
    public function index()
    {
        $allData = [];
        $data = ['歐嚕賣頭', 'kaobo', '陳平偉'];

        foreach ($data as $name) {
            //待采集的目标页面
            $page = 'http://tw.op.gg/summoner/userName=' . $name;

            //列表选择器
            $list = '.SummonerLayoutWrap';

            //采集规则
            $rules = array(
                //content
                'name' => ['.Profile .Name', 'text'],
                'rank' => ['.TierBox', 'html'],
                'content' => ['.tabItem .RecentWinRatio', 'html'],
            );

            //采集
            $result = \QL\QueryList::Query($page, $rules, $list)->data;

            if ( ! empty($result) ) {
                $allData[] = [
                    'rank' => $result[0]['rank'],
                    'name' => $result[0]['name'],
                    'content' => $result[0]['content'],
                ];
            }

        }

        return view('result', [
            'allData' => $allData
        ]);
    }
}