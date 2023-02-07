<?php

namespace BayWaReLusy\UserManagement;

class SubsidiaryEntity implements SubsidiaryInterface
{
    protected string $id;
    protected string $name;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): SubsidiaryEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): SubsidiaryEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getResourceId()
    {
        return 'subsidiary_' . $this->id;
    }
}
