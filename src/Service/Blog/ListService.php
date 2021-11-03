<?php

namespace App\Service\Blog;

use App\Manager\BlogManager;


class ListService
{
    private BlogManager $manager;

    public function __construct(BlogManager $manager)
    {
        $this->manager = $manager;
    }

    public function getData(): array
    {
        return $this->manager->getData();

    }

}