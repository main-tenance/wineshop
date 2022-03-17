<?php

namespace App\Jobs;

abstract class QueueName
{
    public const SEND_PDF_QUEUE = 'send-pdf-queue';
    public const DEFAULT_QUEUE = 'default';
}
