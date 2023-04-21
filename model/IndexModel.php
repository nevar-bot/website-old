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
        $client->channel_count = $json->channel_count->total;

        $json = json_decode(file_get_contents("https://api.nevar.eu/interactions/commands"))->res;
        $client->command_count = $json->command_count;

        $json = json_decode(file_get_contents("https://api.nevar.eu/votes/" . date("m")))->res;
        $client->vote_count = $json->votes;

        return $client;
    }
}