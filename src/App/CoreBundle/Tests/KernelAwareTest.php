<?php

namespace App\CoreBundle\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Test case class helpful with Entity tests requiring access to Symfony container, or the database interaction
 */
abstract class KernelAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \AppKernel
     */
    protected $kernel;
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var Container
     */
    protected $container;
    /**
     * @return null
     */
    public function setUp()
    {
        require_once __DIR__.'/../../../../app/AppKernel.php';

        $this->kernel = new \AppKernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine')->getManager();
        $this->generateSchema();
        parent::setUp();
    }
    /**
     * @return null
     */
    public function tearDown()
    {
        $this->kernel->shutdown();
        parent::tearDown();
    }
    /**
     * @return null
     */
    protected function generateSchema()
    {
        $metadatas = $this->getMetadatas();
        if (!empty($metadatas)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
            $tool->dropSchema($metadatas);
            $tool->createSchema($metadatas);
        }
    }
    /**
     * @return array
     */
    protected function getMetadatas()
    {
        return $this->entityManager->getMetadataFactory()->getAllMetadata();
    }
}