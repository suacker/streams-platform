<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionInterface;

/**
 * Class ActionFactory
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Component\Action
 */
class ActionFactory
{

    /**
     * The default action.
     *
     * @var string
     */
    protected $action = 'Anomaly\Streams\Platform\Ui\Form\Component\Action\Action';

    /**
     * The action registry.
     *
     * @var ActionRegistry
     */
    protected $actions;

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * Create a new ActionFactory instance.
     *
     * @param ActionRegistry $actions
     * @param ButtonRegistry $buttons
     * @param Hydrator       $hydrator
     */
    function __construct(ActionRegistry $actions, ButtonRegistry $buttons, Hydrator $hydrator)
    {
        $this->actions  = $actions;
        $this->buttons  = $buttons;
        $this->hydrator = $hydrator;
    }

    /**
     * Make an action.
     *
     * @param  array $parameters
     * @return ActionInterface
     */
    public function make(array $parameters)
    {
        $action = $original = array_get($parameters, 'action');

        if ($action && $action = $this->actions->get($action)) {
            $parameters = array_replace_recursive($action, array_except($parameters, 'action'));
        }

        $button = array_get($parameters, 'button', $original);

        if ($button && $button = $this->buttons->get($button)) {
            $parameters = array_replace_recursive($button, array_except($parameters, 'button'));
        }

        $action = app()->make(array_get($parameters, 'action', $this->action), $parameters);

        $this->hydrator->hydrate($action, $parameters);

        return $action;
    }
}
