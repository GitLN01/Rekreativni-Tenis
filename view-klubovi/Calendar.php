<?php
class Calendar {
    private $currentYear;
    private $currentMonth;
    private $selectedDate;

    public function __construct() {
        $this->currentYear = date('Y');
        $this->currentMonth = date('m');
        $this->selectedDate = isset($_POST['datum']) ? $_POST['datum'] : date('Y-m-d');
    }

    public function showCalendar() {
        $calendarHTML = '<div class="calendar">';
        $calendarHTML .= $this->generateControls();
        $calendarHTML .= $this->generateCalendarGrid();
        $calendarHTML .= '</div>';
        return $calendarHTML;
    }

    private function generateControls() {
        $controlsHTML = '<div class="calendar-controls">';
        $controlsHTML .= '<button class="btn btn-prev">Previous</button>';
        $controlsHTML .= '<span class="current-month">' . date('F Y', strtotime($this->currentYear . '-' . $this->currentMonth . '-01')) . '</span>';
        $controlsHTML .= '<button class="btn btn-next">Next</button>';
        $controlsHTML .= '</div>';
        return $controlsHTML;
    }

    private function generateCalendarGrid() {
        $firstDayOfMonth = strtotime($this->currentYear . '-' . $this->currentMonth . '-01');
        $daysInMonth = date('t', $firstDayOfMonth);
        $startDay = date('N', $firstDayOfMonth);

        $calendarHTML = '<div class="calendar-grid">';
        $calendarHTML .= '<div class="weekdays">';
        $weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        foreach ($weekdays as $day) {
            $calendarHTML .= '<div class="weekday">' . $day . '</div>';
        }
        $calendarHTML .= '</div>';

        $calendarHTML .= '<div class="days">';
        $dayCounter = 0;
        for ($i = 1; $i <= $startDay - 1; $i++) {
            $calendarHTML .= '<div class="day empty"></div>';
            $dayCounter++;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . $day));
            $calendarHTML .= '<div class="day';
            if ($currentDate === $this->selectedDate) {
                $calendarHTML .= ' selected';
            }
            $calendarHTML .= '">' . $day . '</div>';
            $dayCounter++;
            if ($dayCounter % 7 == 0) {
                $calendarHTML .= '</div><div class="days">';
            }
        }

        $calendarHTML .= '</div></div>';
        return $calendarHTML;
    }
}
