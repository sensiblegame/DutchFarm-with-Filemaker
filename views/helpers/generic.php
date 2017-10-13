<?php

class GenericHelper extends AppHelper {

    public function formatCurrency($number) {
        return number_format(floatval(str_replace(',', '.', $number)), 2,',','.') . ' €';
    }

    public function formatFilesize( $bytes, $decimals=2 ) {

       // Convert the bytes to a string
       $bytes = strval( $bytes );

       // The different units
       $units = array(
           '1152921504606846976' => 'EB',
           '1125899906842624'    => 'PB',
           '1099511627776'       => 'TB',
           '1073741824'          => 'GB',
           '1048576'             => 'MB',
           '1024'                => 'KB'
       );

       // If smaller than 1024, return it as bytes
       if ( $bytes <= 1024 ) {
           return $bytes . ' bytes';
       }

       // Check the right format
       foreach ( $units as $base=>$title ) {
           if ( floor( $bytes / $base ) != 0 ) {
               return number_format( $bytes / $base, $decimals, '.', "'" ) . '' . $title;
           }
       }

   }
}
