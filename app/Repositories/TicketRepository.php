<?php namespace App\Repositories;

use App\Models\Requester;
use App\Repositories\Repository;
use App\Services\MyToken;
use Auth;

// use Illuminate\Support\Facades\DB;

class TicketRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\Models\Ticket";
    }

    public function optionsStatus()
    {
        return [
            'new' => 'Novo',
            'open' => 'Aberto',
            'pending' => 'Pendente',
            'solved' => 'Resolvido',
            'closed' => 'Fechado',
            'merged' => 'Mesclado',
            'spam' => 'Spam',
        ];
    }

    public function colorsStatus()
    {
        return [
            'new' => 'secondary',
            'open' => 'info',
            'pending' => 'warning',
            'solved' => 'success',
            'closed' => 'dark',
            'merged' => 'brown',
            'spam' => 'danger',
        ];

    }

    public function optionsPriority()
    {
        return [
            '' => '---',
            'low' => 'Baixa',
            'medium' => 'Média',
            'high' => 'Alta',
            'urgent' => 'Urgente',
        ];

    }

    public function colorsPriority()
    {
        return [
            '' => '---',
            'low' => 'success',
            'medium' => 'primary',
            'high' => 'warning',
            'urgent' => 'danger',
        ];

    }

    private function syncRequester($attributes, $requester_id = null)
    {
        if (isset($attributes['requester']) and $attributes['requester']) {

            $data = $attributes['requester'];

            if ($requester_id) {
                $requester = Requester::find($requester_id);
            } else {
                $requester = Requester::where('email', $data['email'])->first();
            }

            if (!$requester) {
                $requester = Requester::create($data);
            } else {
                $requester->update($data);
            }
        }

        return $requester;
    }

    /**
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        // DB::beginTransaction();
        $requester = $this->syncRequester($attributes);
        unset($attributes['requester']);

        $attributes['requester_id'] = $requester->id;

        $token = new MyToken($this->model());
        $attributes['public_token'] = $token->unique('', 'public_token', 7);
        $attributes['status'] = 'new';
        $attributes['priority'] = 'medium';

        // $attributes['public_token'] = str_random(24);

        $ticket = parent::create($attributes);
        // DB::rollBack();

        // dd($attributes);
        return $ticket;
    }

    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $instance = $this->find($id);

        $requester = $this->syncRequester($attributes, $instance->requester_id);
        unset($attributes['requester']);

        return parent::update($attributes, $id);
    }

    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function commentAndNotify(array $attributes, $id)
    {

        $instance = $this->find($id);

        if (isset($attributes['new_status']) and $attributes['new_status'] and $attributes['new_status'] != $instance->status) {
            $instance->update(['status' => $attributes['new_status']]);
        } elseif (!isset($attributes['new_status']) or !$attributes['new_status']) {
            $attributes['new_status'] = $instance->status;
        }
        $attributes['user_id'] = Auth::user()->id;

        $instance->comments()->create($attributes);

        return $instance;

    }

}
