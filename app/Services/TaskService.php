<?php

namespace App\Services;

use App\Dto\TaskCreateDto;
use App\Dto\TaskIndexDto;
use App\Dto\TaskUpdateDto;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskService
{

    /**
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(private readonly TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * @param TaskIndexDto $dto
     * @return Collection
     */
    public function getAllByUserId(TaskIndexDto $dto): Collection
    {
        $tasks = $this->taskRepository->getAllByUserId($dto);

        return $tasks->toTree();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        return $this->taskRepository->getById($id);
    }

    /**
     * @param TaskCreateDto $dto
     * @return Model
     */
    public function create(TaskCreateDto $dto): Model
    {
        return $this->taskRepository->create($dto->toArray());
    }

    /**
     * @param int $id
     * @param TaskUpdateDto $dto
     * @return Model|null
     */
    public function update(int $id, TaskUpdateDto $dto): ?Model
    {
        return $this->taskRepository->updateById($id, $dto->toArray());
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->taskRepository->delete($id);
    }
}
