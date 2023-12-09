<?php

namespace App\Repositories\Task;

use DB;
use App\Models\Task;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository
{
    const RELATIONS = [

    ];

    public function __construct(Task $task) {
        parent::__construct($task, self::RELATIONS);
    }

    /**
     * List task
     * @param string $perPage
     */
    public function listTask($perPage, $search) {
        $tasks = DB::table('tasks')
        ->select(
            "tasks.uuid as id",
            "tasks.title as title",
            "tasks.description as description",
            "tasks.status as status",
            DB::raw("DATE_FORMAT(tasks.created_at, '%d/%m/%Y - %H:%i') as date"),
        )
        ->when(!is_null($search), function ($query) use ($search) {
            return $query->orHavingRaw("CONCAT_WS(' ', " . implode(', ', ['title','description','status']) . ") LIKE '%" . $search . "%'");
        })
        ->orderBy("tasks.created_at","DESC")
        ->paginate($perPage);
        return $tasks;
    }


}
