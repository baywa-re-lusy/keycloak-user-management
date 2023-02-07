<?php

namespace BayWaReLusy\UserManagement;

use Laminas\Permissions\Acl\Resource\ResourceInterface;

interface SubsidiaryInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param string $id
     * @return SubsidiaryInterface
     */
    public function setId(string $id): SubsidiaryInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return SubsidiaryInterface
     */
    public function setName(string $name): SubsidiaryInterface;
}
