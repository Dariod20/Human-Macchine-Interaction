@extends('layouts.master')

@section('titolo')
{{ trans('button.book') }}
@endsection

@section('active_prenota','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ trans(key: 'button.book') }}</li>
@endsection
 
<?php
if (!function_exists('build_calendar')){ 
    function build_calendar($month, $year, $tariffe) {
       
    
     // Create array containing abbreviations of days of week.
     $daysOfWeek = trans('messages.days');
     $startDay = app()->getLocale() === 'it' ? 1 : 0;


     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = trans('messages.months')[$month - 1];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    
    if ($startDay === 1 && $dayOfWeek === 0) {
        $dayOfWeek = 6;  // Imposta la domenica come ultimo giorno
    } elseif ($startDay === 1) {
        $dayOfWeek--; // Riduci di uno per iniziare da lunedì
    }
    
    
    $calendar = "<table class='table table-bordered'>";
    $prevMonth = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prevYear = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    
    $currentMonth = date('m');
    $currentYear = date('Y');
    
    $nextMonth = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $nextYear = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
    

    $calendar .= "<center style=\"background-color: white;\"><h2>$monthName $year</h2>";
    $calendar .= "<div class='btn-group'>"; 
    // Controlla se il mese corrente è uguale al mese passato
    if ($month == $currentMonth && $year == $currentYear) {
        // Se siamo nel mese corrente, disabilita il tasto mese precedente
        $calendar .= "<button class='btn btn-xs btn-prev' disabled>" . trans('button.mesePrec') . "</button> ";
        $calendar .= "<button class='btn btn-xs' disabled>" . trans('button.meseCorr') . "</button> ";
    } else {
        $calendar .= "<a class='btn btn-xs btn-prev' href='?month=$prevMonth&year=$prevYear'>" . trans('button.mesePrec') . "</a> ";
        $calendar .= "<a class='btn btn-xs' href='?month=$currentMonth&year=$currentYear'>" . trans('button.meseCorr') . "</a> ";
    }
    $calendar .= "<a class='btn btn-xs btn-next' href='?month=$nextMonth&year=$nextYear'>" . trans('button.meseSucc') . "</a> ";
    $calendar .= "</div></center>";
 
        
      $calendar .= "<tr>";

     // Create the calendar headers

     foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
            $tariffa = $tariffe->firstWhere('giorno', $date);

            if ($date < date('Y-m-d')) {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <span class='btn btn-danger btn-xs disabled-button'>/</span></td>";
            } elseif ($tariffa) {
                if ($tariffa->prenotazione_id) {
                    $calendar .= "<td class='$today'><h4>$currentDay</h4> <span class='btn btn-danger btn-xs disabled-button'>/</span></td>";
                } else {
                    $calendar .= "<td class='$today selectable'><h4>$currentDay</h4> <a href='" . route('prenotazione.conferma', ['arrivo' => $date]) . "' class='btn btn-success btn-xs'>€ $tariffa->prezzo </a></td>";
                }
            } else {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <span class='btn btn-danger btn-xs disabled-button'>/</span></td>";
            }
            
            
           
            
          $calendar .="</td>";
          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
    

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     $calendar .= "<br>";

     echo $calendar;

    }
}
    
?>

@section('corpo')
        <style>
        @media only screen and (max-device-width: 802px){

                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr {
                    display: block;

                }
                
                

                .empty {
                    display: none;
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                th {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr {
                    border: 1px solid #ccc;
                }

                td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }



                /*
            Label the data
            */
                td:nth-of-type(1):before {
                    content: "Sunday";
                }
                td:nth-of-type(2):before {
                    content: "Monday";
                }
                td:nth-of-type(3):before {
                    content: "Tuesday";
                }
                td:nth-of-type(4):before {
                    content: "Wednesday";
                }
                td:nth-of-type(5):before {
                    content: "Thursday";
                }
                td:nth-of-type(6):before {
                    content: "Friday";
                }
                td:nth-of-type(7):before {
                    content: "Saturday";
                }


            }

            /* Smartphones (portrait and landscape) ----------- */

            @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
                body {
                    padding: 0;
                    margin: 0;
                }
            }

            /* iPads (portrait and landscape) ----------- */

            @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
                body {
                    width: 495px;
                }
            }

            @media (min-width:641px) {
                table {
                    table-layout: fixed;
                }
                td {
                    width: 33%;
                }
            }
            
            .row{
                margin-top: 20px;
            }
            
            .today{
                background:yellow;
            }
            
            
            
        </style>



        <div class="container-fluid px-lg-4 mt-4 text-center" id="prenotaOra">
                
                
                        <h1>
                            {{ trans('button.book') }}
                        </h1>
                   
                        <?php
                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month']; 			     
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['mon']; 			     
                                $year = $dateComponents['year'];
                            }
                            echo build_calendar($month, $year, $tariffe);
                        ?>
                    
        </div>

       
    

        
@endsection


