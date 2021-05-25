<?php

namespace App\Http\Controllers;


class MypageController extends Controller
{
    public function __construct(MypageLogic $logic)
    {
        $this->logic = $logic;
    }

    public function index()
    {
        $this->logic->getBacklogUser();
        return view('mypage');
    }
}
