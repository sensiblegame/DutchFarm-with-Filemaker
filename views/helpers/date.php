<?php

class DateHelper extends AppHelper {
    
    public function formatDate($date, $format='%d %B %Y') {
        if (empty($date)) {
            return $this->output('');
        }
        return $this->output(strftime($format, strtotime($date)));
    }
    
    public function formatTime($time, $format='%H:%M') {
        if (empty($time)) {
            return $this->output('');
        }
        return $this->output(strftime($format, strtotime($time)));
    }
    
    public function formatDateTime($datetime, $format='%d %B %Y %H:%M') {
        if (empty($datetime)) {
            return $this->output('');
        }
        return $this->output(strftime($format, strtotime($datetime)));
    }

}