<?php

class IndexModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getBotStats(): object {
        $client = new stdClass();

        $json = json_decode(file_get_contents("https://api.nevar.eu/client/info/stats"));

        $client->guild_count = $json->server_count;
        $client->user_count = $json->user_count;
        $client->channel_count = $json->channel_count->total;
        $client->command_count = $json->command_count;

        $json = json_decode(file_get_contents("https://api.nevar.eu/votes/stats/" . date("m")));

        $client->vote_count = $json->votes;
        return $client;
    }
}