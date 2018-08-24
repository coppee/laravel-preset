<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public function all()
    {
        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->get();
    }

    public function paginated($paginate)
    {
        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function find($id)
    {
        return $this->model
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findByTranslatedSlug(string $slug): Model
    {
        $model = $this->model
            ->where('slug->'.content_locale(), $slug)
            ->first();

        abort_unless($model, 404);

        return $model;
    }

    public function findBySlug(string $slug): Model
    {
        $model = $this->model
            ->where('slug', $slug)
            ->first();

        abort_unless($model, 404);

        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function update($id, array $input)
    {
        $model = $this->find($id);
        $model->fill($input);
        $model->save();

        return $model;
    }
}
