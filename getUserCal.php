<?php
require "config.php";
class Calendar {

public function __construct($year = '', $month = '', $edit = false) {

    $date = time();

    if (empty($year) OR empty($month)) {
        $year = date('Y', $date);
        $month = date('m', $date);
        $day = date('d', $date);
    }
    $mc = ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"];
    $first_day = mktime(0, 0, 0, $month, 1, $year);
    $title = $mc[date('m', $first_day)-1];
    $day_of_week = date('D', $first_day);

     switch ($day_of_week) {
        case "Mon": $blank = 0;
            break;
        case "Tue": $blank = 1;
            break;
        case "Wed": $blank = 2;
            break;
        case "Thu": $blank = 3;
            break;
        case "Fri": $blank = 4;
            break;
        case "Sat": $blank = 5;
            break;
        case "Sun": $blank = 6;
            break;
    }

    $days_in_month = cal_days_in_month(0, $month, $year);

    echo '<table class="centered">';

    echo '<tr>';
    echo '<th colspan=60>' . $title . ' ' . $year . '</th>';
    echo '</tr>';

    echo '<tr class="dzienTygodnia">';
    echo '<td>Pon</td>';
    echo '<td>Wto</td>';
    echo '<td>Śro</td>';
    echo '<td>Czw</td>';
    echo '<td>Pią</td>';
    echo '<td>Sob</td>';
    echo '<td>Nie</td>';
    echo '</tr>';

    $day_count = 1;

    while ($blank > 0) {
        echo '<td></td>';
        $blank = $blank - 1;
        $day_count++;
    }

    $day_num = 1;

    while ($day_num <= $days_in_month) {

        echo '<td class="dzien"';
        if($edit){
            echo ' onclick="showOverlay('.$day_num.','.$month.','.$year.')"';
            }
        
        echo '> '. $day_num . '<br><span class="typDnia">Brak</spn></td>';
        $day_num++;
        $day_count++;

        if ($day_count > 7) {
            echo '</tr><tr>';
            $day_count = 1;
        }
    }

    while ($day_count > 1 && $day_count <= 7) {
        echo '<td> </td>';
        $day_count++;
    }

    echo '</tr>';

    echo '</table>';
    if(!$edit){
    echo '<h3>Edycja Niemożliwa</h3>';
    }
}

}
