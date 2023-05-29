<?php

namespace App\Http\base\repository;

class BaseApiRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * Get all with base filter.
     *
     * @param array $attributes
     * @return mixed
     */
    public function getAll(array $attributes)
    {
        // Select
        $query = $this->model->select("*");

        return $this->result($attributes, $query, $this->model->getTable());
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Save new data
     *
     * @param array $data
     * @param bool $createdBy
     * @return mixed
     */
    public function save(array $data, bool $createdBy = false)
    {
        if ($createdBy)
            $this->createdBy($data);
        return $this->model->create($data);
    }

    /**
     * Update by id
     *
     * @param int $id
     * @param array $data
     * @param bool $updatedBy
     * @param bool $restore
     * @return mixed
     */
    public function updateById(int $id, array $data, bool $updatedBy = false, bool $restore = false)
    {
        if ($updatedBy)
            $this->updatedBy($data);

        if ($restore)
            $item = $this->model->withTrashed()->find($id);
        else
            $item = $this->model->find($id);

        if ($item) {
            if ($restore) $item->restore();
            $item->update($data);
        }
        return $item;
    }

    /**
     * Delete by id
     *
     * @param int $id
     * @param bool $deletedBy
     * @return bool
     */
    public function deleteById(int $id, bool $deletedBy = false): bool
    {
        if ($object = $this->model->find($id)) {
            $object->delete();
            // determine if a given model instance has been soft deleted, use the trashed method:
            if ($object->trashed())
                return true;
        }
        return false;
    }



    public function AES_Encode($plain_text, $key = 'MunjzJan2017')
    {
        return base64_encode(openssl_encrypt($plain_text, 'aes-256-cbc', $key, true, str_repeat(chr(0), 16)));
    }

    public function AES_Decode($base64_text, $key = 'MunjzJan2017')
    {
        return openssl_decrypt(base64_decode($base64_text), 'aes-256-cbc', $key, true, str_repeat(chr(0), 16));
    }
}
