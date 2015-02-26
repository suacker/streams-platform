<?php namespace Anomaly\Streams\Platform\Exception;

use App\Exceptions\Handler;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ExceptionHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Exception
 */
class ExceptionHandler extends Handler
{

    /**
     * Render the given HttpException.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();

        if (!config('app.debug') && view()->exists("streams::errors.{$status}")) {
            return response()->view("streams::errors.{$status}", [], $status);
        } else {
            return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
        }
    }
}