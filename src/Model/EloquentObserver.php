<?php namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Model\Event\ModelsWereDeleted;
use Anomaly\Streams\Platform\Model\Event\ModelsWereUpdated;
use Anomaly\Streams\Platform\Model\Event\ModelWasCreated;
use Anomaly\Streams\Platform\Model\Event\ModelWasDeleted;
use Anomaly\Streams\Platform\Model\Event\ModelWasRestored;
use Anomaly\Streams\Platform\Model\Event\ModelWasSaved;
use Anomaly\Streams\Platform\Model\Event\ModelWasUpdated;
use Anomaly\Streams\Platform\Support\Observer;

/**
 * Class EloquentObserver
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Model
 */
class EloquentObserver extends Observer
{

    /**
     * Run after a record is created.
     *
     * @param EloquentModel $model
     */
    public function created(EloquentModel $model)
    {
        $model->flushCache();
        
        $this->events->fire(new ModelWasCreated($model));
    }

    /**
     * Run after saving a record.
     *
     * @param EloquentModel $model
     */
    public function saved(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelWasSaved($model));
    }

    /**
     * Run after a record has been updated.
     *
     * @param EloquentModel $model
     */
    public function updated(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelWasUpdated($model));
    }

    /**
     * Run after multiple records have been updated.
     *
     * @param EloquentModel $model
     */
    public function updatedMultiple(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelsWereUpdated($model));
    }

    /**
     * Run after a record has been deleted.
     *
     * @param EloquentModel $model
     */
    public function deleted(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelWasDeleted($model));
    }

    /**
     * Run after multiple records have been deleted.
     *
     * @param EloquentModel $model
     */
    public function deletedMultiple(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelsWereDeleted($model));
    }

    /**
     * Run after a record has been restored.
     *
     * @param EloquentModel $model
     */
    public function restored(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->fire(new ModelWasRestored($model));
    }
}
