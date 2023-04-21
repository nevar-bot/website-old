<?php
namespace App\Model;

class CommandsModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getCommands(): array {
        $commands_json = json_decode(file_get_contents("https://api.nevar.eu/interactions/commands"))->res;
        return $commands_json->command_list;
    }
}