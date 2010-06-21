<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/Cases/Case.php');
require_once('opensocial-php-client/osapi/osapi.php');

class PublishActivity {
    function postUpdate($bean, $event, $arguments) {
        
        if ($bean->parent_type == "Cases" && $bean->parent_id) {
            $case = new aCase();
            $case->retrieve($bean->parent_id);

            if ($bean->module_dir == "Notes") {
                if (!$bean->fetched_row) {
                    $this->_sendActivity($case, "The note \"".$bean->name."\" has been created.");
                } else {
                    $this->_sendActivity($case, "The note \"".$bean->name."\" has been updated.");
                }
            }
            
            if ($bean->module_dir == "Tasks") {
                if (!$bean->fetched_row) {
                    $this->_sendActivity($case, "The task \"".$bean->name."\" has been created.");
                } else if ($bean->fetched_row["status"] != $bean->status || $bean->fetched_row["priority"] != $bean->priority) {
                    if ($bean->fetched_row["status"] != $bean->status) {
                        $this->_sendActivity($case, "The status of the task \"".$bean->name."\" has been changed from ".$bean->fetched_row["status"]." to ".$bean->status.".");
                    }
                    if ($bean->fetched_row["priority"] != $bean->priority) {
                        $this->_sendActivity($case, "The priority of the task \"".$bean->name."\" has been changed from ".$bean->fetched_row["priority"]." to ".$bean->priority.".");
                    }
                } else {
                    $this->_sendActivity($case, "The task \"".$bean->name."\" has been updated.");
                }
            }
            
            if ($bean->module_dir == "Calls") {
                if (!$bean->fetched_row) {
                    $this->_sendActivity($case, "The call \"".$bean->name."\" has been created.");
                } else {
                    $this->_sendActivity($case, "The call \"".$bean->name."\" has been updated.");
                }
            }
            
            if ($bean->module_dir == "Emails") {
                if (!$bean->fetched_row) {
                    $this->_sendActivity($case, "The email \"".$bean->name."\" has been created.");
                } else {
                    $this->_sendActivity($case, "The email \"".$bean->name."\" has been updated.");
                }
            }
            
            if ($bean->module_dir == "Meetings") {
                if (!$bean->fetched_row) {
                    $this->_sendActivity($case, "The meeting \"".$bean->name."\" has been scheduled to start on ".$bean->date_start.".");
                } else if ($bean->date_start != $bean->fetched_row["date_start"]) {
                    $this->_sendActivity($case, "The meeting \"".$bean->name."\" has been re-scheduled to start on ".$bean->date_start.".");
                } else {
                    $this->_sendActivity($case, "The meeting \"".$bean->name."\" has been updated.");
                }
            }
            
            if ($bean->module_dir == "Bugs") {
                $this->_sendActivity($case, "The bug \"".$bean->name."\" has been updated.");
            }

            
            
        } else if ($bean->module_dir == "Cases") {
            if (!$bean->fetched_row) {
                //The case is new, there is no space listening yet.
                return;
            }
            $sent = false; 
            if ($bean->name != $bean->fetched_row["name"]) {
                $sent = true;
                $this->_sendActivity($bean, "The case has been renamed to \"".$bean->name."\".");
            } 
            if ($bean->priority != $bean->fetched_row["priority"]) {
                $sent = true;
                $this->_sendActivity($bean, "The priority if the case has been changed from \"".$bean->fetched_row["priority"]."\" to \"".$bean->priority."\".");
            }
            if ($bean->fetched_row["status"] != $bean->status) {
                $sent = true;
                $this->_sendActivity($bean, "The status of the case has been changed from ".$bean->fetched_row["status"]." to ".$bean->status.".");
            }
            if (!$sent) {
                $this->_sendActivity($bean, "The case has been updated.");
            }
        }
        
    }
    
    function _getConfig() {
        require_once('config_spaces.php');
        return $GLOBAL['spaces_config'];
    }
    
    function _sendActivity($case, $activity) {
        $spaceName = "Sugar: Cases ".$case->case_number;
        
        $activity = $GLOBALS["current_user"]->full_name.": ".$activity;
        
        $spaces_config = $this->_getConfig();
        
        $provider = new osapiProvider("", "", "", "", $spaces_config["os_rpc_url"], "eXo Social", true, null);
        $auth = new osapiOAuth2Legged($spaces_config["os_oauth_key_name"], $spaces_config["os_oauth_key_secret"], $spaces_config["os_user"]);
        $osapi = new osapi($provider, $auth);
        
        
        $osactivity = new osapiActivity();
        
        $osactivity->setTitle($activity);
        $osactivity->setBody($activity);
        
        $params = array(
          'userId' => '@me',
          'groupId' => "space:".$spaceName,
          'activity' => $osactivity,
        );

        // Start a batch
        $batch = $osapi->newBatch();
        $batch->add($osapi->activities->create($params));
        $result = $batch->execute();
    }
}
?>