<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeDuplicator;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class EntryDuplicator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryDuplicator
{

    /**
     * Duplicate an entry.
     *
     * @param EntryInterface $entry
     * @return EntryInterface
     */
    public function duplicate(EntryInterface $entry)
    {
        /* @var EloquentModel $entry */
        $clone = $entry->newInstance();

        foreach ($entry->getAssignments() as $assignment) {

            /* @var FieldTypeDuplicator $duplicator */
            $duplicator = $assignment
                ->getFieldType()
                ->getDuplicator();

            $duplicator->copy($entry, $clone);
        }

        return $clone;
    }
}
