<?php
namespace App\Model;

class IndexModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getStats(): object {
        $client = new \stdClass();

        $json = json_decode(file_get_contents("https://api.nevar.eu/client/stats"))->res;
        $client->guild_count = $json->server_count;
        $client->user_count = $json->user_count;
        $client->channel_count = $json->channel_count;
        $client->command_count = $json->command_count;
        $client->vote_count = $json->vote_count;

        return $client;
    }

    public function getStaffs(): array {
        $staffs = array();

        $json = json_decode(file_get_contents("https://api.nevar.eu/client/staffs"))->res;
        foreach($json->staffs as $staff){
            $staffs[] = $staff;
        }

        return $staffs;
    }
}