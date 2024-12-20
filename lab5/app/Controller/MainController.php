<?php

namespace Labs\Lab5\Controller;

class MainController
{
    public function checkRequest($request)
    {
        if (array_key_exists('delete_expert', $request)) {
            (new ExpertController)->delete($request['delete_expert']);
        }
        if (array_key_exists('delete_client', $request)) {
            (new ClientController)->delete($request['delete_client']);
        }
        if (array_key_exists('delete_pledge', $request)) {
            (new PledgeController())->delete($request['delete_pledge']);
        }
    }
}