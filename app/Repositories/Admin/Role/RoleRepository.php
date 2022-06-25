<?php

namespace App\Repositories\Admin\Role;

use App\Exceptions\GeneralException;
use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;
use DB;

class RoleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Role::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'roles.id',
                'roles.name',
                'roles.created_at',
                'roles.updated_at',
            ]);
    }

    public function retrieveData(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }
}