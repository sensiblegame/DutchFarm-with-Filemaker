<?php

// Import the FileMaker PHP API
App::import('vendor', 'filemaker', 'FileMaker');

// The base class for all FileMaker connections
class AppModel {
    
    // Get a database connection
    protected function _getConnection() {
        $dbCfg = new DATABASE_CONFIG();
        $settings = $dbCfg->default;
        return new FileMaker(
            $settings['database'], $settings['host'],
            $settings['login'], $settings['password']
        );
    }
    
    // Add a new record
    protected function _add($layout, $params) {
        $conn = $this->_getConnection();
        $cmd  = $conn->newAddCommand($layout);
        foreach ($params as $param => $value) {
            $cmd->setField($param, $value);
        }
        $result = $cmd->execute();
        return $this->_getFirstRecord($result);
    }
    
    // Edit a record
    protected function _edit($layout, $params) {
        $conn = $this->_getConnection();
        $cmd  = $conn->newEditCommand($layout, $params['RECORD_ID']);
        foreach ($params as $param => $value) {
            if ($param != 'RECORD_ID' && $param != 'MODIF_ID') {
                $cmd->setField($param, $value);
            }
        }
        $result = $cmd->execute();
        return $this->_getFirstRecord($result);
    }
    
    // Find all records based on some parameters
    protected function _find($layout, $params, $sorting=array()) {
        $conn = $this->_getConnection();
        $cmd  = $conn->newFindCommand($layout);
        foreach ($params as $param => $value) {
            $cmd->addFindCriterion($param, $value);
        }
        foreach ($sorting as $i => $sort) {
            if (substr($sort, 0, 1) == '-') {
                $cmd->addSortRule(substr($sort, 1), ($i+1), FILEMAKER_SORT_DESCEND);
            } else {
                $cmd->addSortRule($sort, ($i+1), FILEMAKER_SORT_ASCEND);
                
            }
        }
        $result = $cmd->execute();
        return $this->_processResult($result);
    }
    
    // Find one single record
    protected function _findOne($layout, $params) {
        $result = $this->_find($layout, $params);
        return ($result && count($result) > 0) ? $result[0] : false;
    }
    
    // Find a random single record
    protected function _findRandom($layout, $params) {
        $conn = $this->_getConnection();
        $cmd  = $conn->newFindAnyCommand($layout);
        foreach ($params as $param => $value) {
            $cmd->addFindCriterion($param, $value);
        }
        $result = $cmd->execute();
        $result = $this->_processResult($result);
        return (count($result) > 0) ? $result[0] : false;
    }
    
    // Get the contents of a container field
    protected function _getContainer($url) {
        $conn = $this->_getConnection();
        return $conn->getContainerData($url);
    }
    
    // Get the first record from a result
    protected function _getFirstRecord($result) {
        $result = $this->_processResult($result);
        if ($result) {
            return $result[0];
        } else {
            return $result;
        }
    }
    
    // Function that converts a FileMaker result object to something easier to
    // work with in a web application
    protected function _processResult($result) {
        
        // Check for errors
        if (FileMaker::isError($result)) {

            // Check that it's a NotFound error, if yes, return an empty array
            if ($result->getCode() == 401) {
                return false;
            } else {
                echo('FileMaker Error: ' . $result->getMessage());
                echo('');
                trigger_error($result->getMessage()  . PHP_EOL . $this->getStackTrace(), E_USER_ERROR);
            }
            
        }
        
        // Not an error, convert the result to a regular array
        $processedResult = array();
        foreach ($result->getRecords() as $record) {
            $processedRecord = array();
            $processedRecord['RECORD_ID'] = $record->getRecordId();
            $processedRecord['MODIF_ID']  = $record->getModificationId();
            foreach ($record->getFields() as $field) {
                $processedRecord[$field] = $record->getFieldUnencoded($field);
            }
            $processedResult[] = $processedRecord;
        }
        
        // Return the result
        return $processedResult;
        
    }
    
    // Get a formatted stack trace
    private function getStackTrace() {
        $err = '';
        $err .= 'Debug backtrace:' . PHP_EOL;
        foreach( debug_backtrace() as $t ) {
            $err .= '    @ ';
            if ( isset( $t['file'] ) ) {
                $err .= basename( $t['file'] ) . ':' . $t['line'];
            } else {
                $err .= basename( $_SERVER['PHP_SELF'] );
            }
            $err .= ' -- ';
            if ( isset( $t['class'] ) ) {
                $err .= $t['class'] . $t['type'];
            }
            $err .= $t['function'];
            if ( isset( $t['args'] ) && sizeof( $t['args'] ) > 0 ) {
                $err .= '(...)';
            } else {
                $err .= '()';
            }
            $err .= PHP_EOL;
        }
        return $err;
    }
    
}