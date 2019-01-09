<?php
/**
 * A class representing a single Thing item
 */
class MorrisonRedirect extends PerchAPI_Base
{
    protected $table     = 'redirects';
    protected $pk        = 'id';

    public function status_string()
    {
        $check = '<span style="color: #00CC00; width: 12px; display: inline-block;">&#x2714;</span>';
        $cross = '<span style="color: #CC0000; width: 12px; display: inline-block;">&#x2718;</span>';
        $format = 'm-d-Y@g:ia';
        switch ($this->status()) {
            case 'enabled':
                return $check . ' Enabled';
            case 'disabled':
                return $cross . ' Disabled';
            case 'scheduled':
                $current = new DateTime('now');
                $start = new DateTime($this->start_date());
                $end = new DateTime($this->end_date());
                $state = $check . ' Active - Until '. $end->format($format);
                if ($current > $end) {
                    $state = $cross . ' Past - Ended '. $end->format($format);
                }
                if ($current < $start) {
                    $state =  $cross . ' Future - Starts '. $start->format($format);
                }
                return "{$state}";
        }
    }
}
