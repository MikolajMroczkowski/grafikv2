<?php
require "config.php";
class Calendar
{

    public function __construct($year = '', $month = '', $edit = false)
    {

        $date = time();

        if (empty($year) or empty($month)) {
            $year = date('Y', $date);
            $month = date('m', $date);
            $day = date('d', $date);
        }
        $mc = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
        $first_day = mktime(0, 0, 0, $month, 1, $year);
        $title = $mc[date('m', $first_day) - 1];
        $day_of_week = date('D', $first_day);

        switch ($day_of_week) {
            case "Mon":
                $blank = 0;
                break;
            case "Tue":
                $blank = 1;
                break;
            case "Wed":
                $blank = 2;
                break;
            case "Thu":
                $blank = 3;
                break;
            case "Fri":
                $blank = 4;
                break;
            case "Sat":
                $blank = 5;
                break;
            case "Sun":
                $blank = 6;
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
        require "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('Błąd renderu');
        }
        $conn->query("set names utf8;");
        while ($day_num <= $days_in_month) {


            echo '<td ';
            if ($edit) {
                echo 'class="dzienEdit" onclick="showOverlay(' . $day_num . ',' . $month . ',' . $year . ')"';
            }
            else{
                echo 'class="dzienNoEdit"';
            }
            echo '> ' . $day_num . '<br><span class="typDnia">';
            $sql = "SELECT days.etykieta as typ from daneDni as dates LEFT JOIN typyDni as days ON days.id = dates.typeDay WHERE dates.user=".$_SESSION['id']." AND dates.date = '".$year."-".$month."-".$day_num."';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo $row['typ'];
                }
            } else {
                echo 'Brak';
            }

            echo '</spn></td>';
            $day_num++;
            $day_count++;

            if ($day_count > 7) {
                echo '</tr><tr>';
                $day_count = 1;
            }
        }
        $conn->close();
        while ($day_count > 1 && $day_count <= 7) {
            echo '<td> </td>';
            $day_count++;
        }

        echo '</tr>';

        echo '</table>';
        if (!$edit) {
            echo '<h3>Edycja Niemożliwa</h3>';
        }
    }
}
