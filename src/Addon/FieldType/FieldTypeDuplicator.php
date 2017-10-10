<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class FieldTypeDuplicator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeDuplicator
{

    /**
     * The field type instance.
     *
     * @var FieldType
     */
    protected $fieldType;

    /**
     * Create a new FieldTypeDuplicator instance.
     *
     * @param FieldType $fieldType
     */
    public function __construct(FieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Copy the content from the
     * original to the clone.
     *
     * @param EntryInterface $original
     * @param EntryInterface $clone
     */
    public function copy(EntryInterface $original, EntryInterface $clone)
    {
        $clone->setAttribute(
            $this->fieldType->getField(),
            $original->getAttribute($this->fieldType->getField())
        );
    }
}
