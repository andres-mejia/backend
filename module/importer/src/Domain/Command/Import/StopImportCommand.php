<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Importer\Domain\Command\Import;

use Ergonode\EventSourcing\Infrastructure\DomainCommandInterface;
use Ergonode\SharedKernel\Domain\Aggregate\ImportId;
use JMS\Serializer\Annotation as JMS;

class StopImportCommand implements DomainCommandInterface
{
    /**
     * @JMS\Type("Ergonode\SharedKernel\Domain\Aggregate\ImportId")
     */
    private ImportId $id;

    /**
     * @JMS\Type("string")
     */
    private ?string $reason;

    public function __construct(ImportId $id, ?string $reason = null)
    {
        $this->id = $id;
        $this->reason = $reason;
    }

    public function getId(): ImportId
    {
        return $this->id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }
}
