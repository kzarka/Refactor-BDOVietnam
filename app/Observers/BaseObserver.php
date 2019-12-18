<?php

namespace App\Observers;
use Auth;
use App\Models\Log\ActivityLog;

class BaseObserver 
{
    /**
     * Handle the model "saving" event.
     *
     * @return void
     */
    public function saving($model)
    {
        $dirty = $model->getDirty();
        $origin = $model->getOriginal();
        if(count($dirty) == 0) return;
        $className = $model->getMorphClass();
        if (count($origin) == 0) {
            return;
        }
        // Data was updated
        $action = ACTION_UPDATED;
        
        if($className == POST_TYPE) {
            if($model->approved != $origin['approved']) {
                $action = ACTION_APPROVED;
            }
        }

        if($className == USER_TYPE) {
            if($model->last_login !== $origin['last_login']) return;
            if($model->banned_until != $origin['banned_until'] | $model->active != $origin['active']) {
                $action = ACTION_BANNED;
            }
        }
        
        if (Auth::check()) {
            ActivityLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'entity_type' => $className,
                'entity_id'    => $model->id
            ]);
        }
    }

    /**
     * Handle the model "saved" event.
     *
     * @return void
     */
    public function saved($model)
    {

    }

    /**
     * Handle the model "created" event.
     *
     * @return void
     */
    public function created($model)
    {
        $action = ACTION_CREATED;
        $className = $model->getMorphClass();
        if (Auth::check()) {
            ActivityLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'entity_type' => $className,
                'entity_id'    => $model->id
            ]);
        }
    }

    /**
     * Handle the model "updated" event.
     *
     * @return void
     */
    public function updated($model)
    {
        //
    }

    /**
     * Handle the model "deleting" event.
     *
     * @return void
     */
    public function deleting($model)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => ACTION_DELETED,
                'on_model' => $model->getTable(),
                'model_id'    => $model->id
            ]);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @return void
     */
    public function deleted($model)
    {

    }

    /**
     * Handle the model "restored" event.
     *
     * @return void
     */
    public function restored($model)
    {
        //
    }

    /**
     * Handle the model "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted($model)
    {

    }
}