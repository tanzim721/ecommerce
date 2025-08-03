<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {
        return view('home.index');
    }

    

}

// লারাভেল Facades  কী?

// আমরা যে class ইউজ করি, facades তাতে  static interface provide করে, যা service container এর মধ্যে এভেইলেভল।

// লারাভেলে অনেকগুলো facades provide করে যা লারাভেল এর মধ্যকার ফিচারগুলো যেমন cache, config, route, blade ইত্যাদি ব্যবহার করতে সহায়তা করে।

// Facades "static proxies " হিসেবে কাজ করে, যা অনেকগুলো benefits দেয়

// লারাভেলের সকল facades " Illuminate\Support\Facades " এই namespace এ define করা আছে।

// __callStatic ( $method, $args )  মেথডের মাধ্যমে লারাভেল facade কাজ করে থাকে।

// এই মেথডটি static method call এর সময় কল হয়।
// এই মেথডের মাধ্যমে service container থেকে service resolve করে, এবং সেই service এর method call করে।
