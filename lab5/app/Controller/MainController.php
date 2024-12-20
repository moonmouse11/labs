<?php

namespace Labs\Lab5\Controller;

class MainController
{
    public function checkRequest($request)
    {
        if (array_key_exists('pledge_create', $request)) {
            (new PledgeController())->save($request);
        }
        if (array_key_exists('expert_create', $request)) {
            (new ExpertController())->save($request);
        }
        if (array_key_exists('client_create', $request)) {
            (new ClientController())->save($request);
        }
        if (array_key_exists('pledge_update_id', $request)) {
            (new PledgeController())->update($request['pledge_update_id'],$request);
        }
        if (array_key_exists('expert_update_id', $request)) {
            (new ExpertController())->update($request['expert_update_id'], $request);
        }
        if (array_key_exists('client_update_id', $request)) {
            (new ClientController())->update($request['client_update_id'], $request);
        }

        if (array_key_exists('expert_delete_id', $request)) {
            (new ExpertController)->delete($request['expert_delete_id']);
        }
        if (array_key_exists('client_delete_id', $request)) {
            (new ClientController)->delete($request['client_delete_id']);
        }
        if (array_key_exists('pledge_delete_id', $request)) {
            (new PledgeController())->delete($request['pledge_delete_id']);
        }
    }


}