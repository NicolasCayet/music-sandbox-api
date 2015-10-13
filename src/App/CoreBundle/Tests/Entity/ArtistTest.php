<?php

namespace App\CoreBundle\Tests\Entity;

use App\CoreBundle\Entity\Artist;
use App\CoreBundle\Tests\KernelAwareTest;
use App\CoreBundle\Entity\Single;
use App\CoreBundle\Entity\Band;

class ArtistTest extends KernelAwareTest
{
    /**
     * Test basic actions on the Artist repositories (Band & Single)
     * + test auto-generated ids
     */
    public function testRepoActions()
    {
        $artistRepo = $this->entityManager->getRepository(Artist::class);
        $bandRepo = $this->entityManager->getRepository(Band::class);
        $singleRepo = $this->entityManager->getRepository(Single::class);

        // No entity with ID 1 exists
        $entity = $bandRepo->find(1);
        $this->assertNull($entity);

        $band = new Band();
        $band->setName("TestBand");
        $this->entityManager->persist($band);
        $this->entityManager->flush($band);

        // ID generated for the persisted Band is 1
        $this->assertEquals(1, $band->getId());

        // Clear entity manager cache before testing with find() method
        $this->entityManager->clear();

        // ID 1 corresponds to the previously persisted Band
        $band = $bandRepo->find(1);
        $this->assertNotNull($band);

        // No Single artists in database
        $singles = $singleRepo->findAll();
        $this->assertEmpty($singles);

        $single = new Single();
        $single->setName("TestSingle");
        $this->entityManager->persist($single);
        $this->entityManager->flush($single);

        // Clear entity manager cache after new entity persisted
        $this->entityManager->clear();

        // findAll() on Single artist repository is not empty
        $singles = $singleRepo->findAll();
        $this->assertNotEmpty($singles);

        // findAll() on Artist (any types) repository has 2 entries
        $artists = $artistRepo->findAll();
        $this->assertEquals(2, count($artists));
    }
}