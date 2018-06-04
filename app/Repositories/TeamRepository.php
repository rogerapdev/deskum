<?php namespace App\Repositories;

use App\Models\Membership;
use App\Repositories\Repository;

class TeamRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\Models\Team";
    }

    public function syncMemberships($memberships, $id)
    {
        if (is_array($memberships)) {
            $memberships = collect($memberships);
        }

        $items = Membership::where('team_id', $id)->get();

        $items->each(function ($item) use ($memberships) {
            if (!$memberships->where('user_id', $item->user_id)->first()) {
                Membership::find($item->id)->delete();
            }
        });

        $memberships->each(function ($member) use ($id, $items) {

            if ($member['user_id']) {

                $data = [
                    'team_id' => $id,
                    'user_id' => $member['user_id'],
                    'admin' => (isset($member['admin']) and $member['admin']) ? 1 : 0,
                ];
                // dd($data);
                $found = $items->where('user_id', $member['user_id'])->first();
                if (!$found) {
                    Membership::create($data);
                } else {
                    $found->update($data);
                }
            }
        });
    }
}
