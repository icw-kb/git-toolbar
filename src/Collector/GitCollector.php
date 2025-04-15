<?php

namespace icwkb\GitToolbar\Collector;

use Gitonomy\Git\Repository;
use icwkb\GitToolbar\Filter\GitVersionFilter;
use Laminas\DeveloperTools\Collector\AbstractCollector;
use Laminas\Mvc\MvcEvent;


class GitCollector extends AbstractCollector
{
        private $config = [];

    public function collect(MvcEvent $mvcEvent)
    {
        $config = $mvcEvent->getApplication()->getServiceManager()->get('Config');
        $this->config = $config['laminas-developer-tools']['toolbar']['git-toolbar'] ?? [];
    }
    public function getName()
    {
        return 'git.toolbar';
    }
    public function getPriority()
    {
        return 15;
    }

    public function getGitVersion()
    {
        $filter = new GitVersionFilter();
        $repository = $this->getRepository();
        return $filter->filter($repository->run('version'));

    }

    public function getRepository()
    {
        $directory = $this->getDirectory();
        $repository = new Repository($directory);
        return $repository;
    }

    public function getDirectory()
    {
        return getcwd();
    }

    public function getSize()
    {
        return $this->getRepository()->getSize() . 'KB';
    }

    public function getBranches()
    {
        $findBranchesFor = $this->config['find-branches-for'] ?? [];
        if (empty($findBranchesFor)) {
            return ['/' => $this->getRepository()->getHead()->getName()];
        }
        $branches = [];
        foreach ($findBranchesFor as $branch) {
            if (!is_dir($branch)) {
                continue;
            }
            $repo = new Repository(getcwd() . '/' . $branch);
            $branches[$branch] = $repo->getHead()->getName();
        }
        return $branches;
    }

}