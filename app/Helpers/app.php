<?php

use Carbon\Carbon;
use Laravolt\Avatar\Avatar;

if (!function_exists('classTime')) {
    function classTime() {
        return  [
            '07:00:00' => '07:00',
            '08:00:00' => '08:00',
            '09:00:00' => '09:00',
            '10:00:00' => '10:00',
            '11:00:00' => '11:00',
            '12:00:00' => '12:00',
            '13:00:00' => '13:00',
            '14:00:00' => '14:00',
            '15:00:00' => '15:00',
            '16:00:00' => '16:00',
            '17:00:00' => '17:00',
            '18:00:00' => '18:00',
            '19:00:00' => '19:00',
            '20:00:00' => '20:00',
        ];
    }
}

if (!function_exists('classWeek')) {
    function classWeek($id="") {
        $data =  [
            0 => 'Domingo',
            1 => 'Segunda-Feira',
            2 => 'Terça-Feira',
            3 => 'Quarta-Feira',
            4 => 'Quinta-Feira',
            5 => 'Sexta-Feira',
            6 => 'Sábado'
        ] ;

        if(!isset($data[$id])) {
            return $data;
        }

        return $data[$id];
    }
}

if(!function_exists('currency')) {
    function currency($value=null, $toDatabase=false) {
        if (empty($value)) {
            return;
        }

        if($toDatabase) {
            return str_replace(",", ".", str_replace('.', '', $value));
        }
        
        return number_format($value, 2, ",", ".");
    }
}

if(!function_exists('avatar')) {
    function avatar($text) {
        return (new Avatar())->create(strtoupper($text))->toBase64();
    }
}

if(!function_exists('theme')) {
    function theme($default="purple") {
        return session('tenant_theme') ?? $default;
    }
}

if(!function_exists('dateExt')) {
    
    function dateExt($date) {

        $date = Carbon::parse($date)->locale('pt-BR');
        $w = date('w', strtotime($date));
        $weekdayName = classWeek($w);
        return $weekdayName.', ' . $date->translatedFormat('d \d\e F \d\e Y');
    }
}
